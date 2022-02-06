<?php

declare(strict_types=1);

namespace Ecommerce\Tests\Acceptance\Context;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Ecommerce\Tests\Shared\Infrastructure\Mink\MinkHelper;
use Ecommerce\Tests\Shared\Infrastructure\Mink\MinkSessionRequestHelper;
use Exception;
use RuntimeException;

use function Lambdish\Phunctional\each;

final class ApiContext extends RawMinkContext
{
    protected MinkHelper $sessionHelper;

    protected Session $minkSession;

    protected MinkSessionRequestHelper $request;

    public function __construct(
        Session $minkSession,
        private EntityManagerInterface $entityManager
    ) {
        $this->minkSession = $minkSession;
        $this->sessionHelper = new MinkHelper($this->minkSession);
        $this->request = new MinkSessionRequestHelper(new MinkHelper($minkSession));
    }

    public function save(array $collection, string $className): void
    {
        each(
            function (array $primitives) use ($className) {
                $aggregate = $className::fromArrayOfPrimitives($primitives);
                $this->entityManager->persist($aggregate);
            },
            $collection
        );
        $this->entityManager->flush();
    }

    /**
     * @Given I send a :method request to :url
     */
    public function iSendARequestTo(string $method, string $url): void
    {
        $this->request->sendRequest($method, $this->locatePath($url));
    }

    /**
     * @When I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody(string $method, string $url, PyStringNode $body): void
    {
        $this->request->sendRequestWithPyStringNode($method, $this->locatePath($url), $body);
    }

    /**
     * @When I send a :method request to :url with parameters:
     */
    public function iSendARequestToWithParameters(string $method, string $url, PyStringNode $body): void
    {
        $parameters = json_decode($body->getRaw(), true);
        $this->request->sendRequest($method, $this->locatePath($url), [
            'parameters' => $parameters,
        ]);
    }

    /**
     * @When I send a :method request to :url with authorization code generated and with parameters:
     */
    public function iSendARequestToWithAuthorizationCodeGeneratedAndWithParameters(
        string $method,
        string $url,
        PyStringNode $body
    ): void {
        $code = $this->sessionHelper->getParameterFromCurrentURL('code');

        $parameters = json_decode($body->getRaw(), true);
        $parameters['code'] = $code;

        $this->request->sendRequest($method, $this->locatePath($url), [
            'parameters' => $parameters,
        ]);
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $expectedResponse): void
    {
        $expected = $this->sanitizeOutput($expectedResponse->getRaw());
        $actual = $this->sanitizeOutput($this->sessionHelper->getResponse());

        if ($expected !== $actual) {
            throw new RuntimeException(
                sprintf("The outputs does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s", $expected, $actual)
            );
        }
    }

    /**
     * @Then the response should be empty
     */
    public function theResponseShouldBeEmpty(): void
    {
        $actual = trim($this->sessionHelper->getResponse());

        if (!empty($actual)) {
            throw new RuntimeException(
                sprintf("The outputs is not empty, Actual:\n%s", $actual)
            );
        }
    }

    /**
     * @Then the response should not be empty
     */
    public function theResponseShouldNotBeEmpty(): void
    {
        $actual = trim($this->sessionHelper->getResponse());

        if (empty($actual)) {
            throw new RuntimeException(sprintf('The output is empty'));
        }

        $decoded = json_decode($actual, true);

        if (!(\count($decoded) > 0)) {
            throw new RuntimeException(sprintf('The output is empty'));
        }
    }

    /**
     * @Then print last api response
     */
    public function printApiResponse(): void
    {
        print_r($this->sessionHelper->getResponse());
    }

    /**
     * @Then print response headers
     */
    public function printResponseHeaders(): void
    {
        print_r($this->sessionHelper->getResponseHeaders());
    }

    /**
     * @Then the response status code should be :expectedResponseCode
     */
    public function theResponseStatusCodeShouldBe(string $expectedResponseCode): void
    {
        if ($this->minkSession->getStatusCode() !== (int)$expectedResponseCode) {
            $previousException =
                new Exception(sprintf('HTTP Request TRACE: [%s]', $this->minkSession->getDriver()->getContent()));

            throw new RuntimeException(
                sprintf(
                    'The status code <%s> does not match the expected <%s>',
                    $this->minkSession->getStatusCode(),
                    $expectedResponseCode
                ),
                0,
                $previousException
            );
        }
    }

    /**
     * @When I send a :method request to :url with refresh token generated and with parameters:
     */
    public function iSendARequestToWithRefreshTokenGeneratedAndWithParameters(
        string $method,
        string $url,
        PyStringNode $body
    ): void {
        $response = json_decode($this->sessionHelper->getResponse(), true);

        $parameters = json_decode($body->getRaw(), true);
        $parameters['refresh_token'] = $response['refresh_token'];

        $this->request->sendRequest($method, $this->locatePath($url), [
            'parameters' => $parameters,
        ]);
    }

    /**
     * @Then /^the response should contain "(?P<text>(?:[^"]|\\")*)"$/
     */
    public function assertResponseContains(mixed $parameter): void
    {
        $response = json_decode($this->sessionHelper->getResponse(), true);

        if (!\array_key_exists($parameter, $response)) {
            throw new RuntimeException(
                sprintf("The output doesn't contain variable %s", $parameter)
            );
        }
    }

    private function sanitizeOutput(string $output): string
    {
        return json_encode(json_decode(trim($output), true));
    }
}