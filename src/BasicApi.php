<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace Api;

use Api\Entity\Factory\EntityFromApiObjectFactory;
use Api\Entity\Lesson;
use Api\Exception\ApiConnectionException;
use Api\Exception\ApiException;
use Api\Exception\BadApiEntityException;

class BasicApi implements ApiInterface
{
    /** @var string **/
    private $apiBaseUrl;

    /** @var string **/
    private $user;

    /** @var string **/
    private $password;

    public function __construct(string $apiBaseUrl, string $user, string $password)
    {
        $this->apiBaseUrl = $apiBaseUrl;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param string|null $category
     * @return Lesson[]
     * @throws ApiConnectionException
     * @throws ApiException
     * @throws BadApiEntityException
     */
    public function getLessons(string $category = null): array
    {
        $params = [];

        if ($category) {
            $params['category'] = $category;
        }

        $data = $this->makeRequest('/lessons', $params);
        if (!is_array($data)) {
            throw new ApiException('Unable to parse API response: /lessons should return array');
        }

        return EntityFromApiObjectFactory::createLessonsFromArray($data);
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return mixed
     * @throws ApiConnectionException
     * @throws ApiException
     */
    public function makeRequest(string $endpoint, array $params = [])
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->apiBaseUrl . $endpoint . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_USERPWD, $this->user . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        if (curl_errno($ch) && $error = curl_error($ch)) {
            curl_close($ch);
            throw new ApiConnectionException($error);
        }

        curl_close($ch);

        if (!$decodedResult = json_decode($output, false)) {
            throw new ApiException('Unable to decode API response');
        }

        return $decodedResult;
    }
}
