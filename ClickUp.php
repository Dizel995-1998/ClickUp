<?php

namespace Service\ClickUp;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use Service\ClickUp\Entity\Folder;
use Service\ClickUp\Entity\Folders;
use Service\ClickUp\Entity\ListEntity;
use Service\ClickUp\Entity\Lists;
use Service\ClickUp\Entity\Space;
use Service\ClickUp\Entity\Spaces;
use Service\ClickUp\Entity\Task;
use Service\ClickUp\Entity\Tasks;
use Service\ClickUp\Entity\Teams;
use Service\ClickUp\Entity\TimeCollection;
use Service\ClickUp\Entity\TrackedTimeWithIntervals;

class ClickUp
{
    private string $tokenApi;

    private \GuzzleHttp\Client $client;

    const BASE_URL = 'https://api.clickup.com/api/v2';

    public function __construct(string $tokenApi, \GuzzleHttp\Client $client)
    {
        if (!$tokenApi) {
            throw new InvalidArgumentException('Token must be not empty');
        }

        $this->client = $client;
        $this->tokenApi = $tokenApi;
    }

    /**
     * Отправляет HTTP запрос к ClickUp'u
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    private function sendRequest(string $method, string $url)
    {
        $response = $this->client->request($method, self::BASE_URL . $url, ['headers' => ['Authorization' => $this->tokenApi]]);
        if (strstr((string) $response->getHeader('Content-type'), 'application/json') === null) {
            throw new \HttpInvalidParamException('Response contain dont json');
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return Teams
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getTeams() : Teams
    {
        return new Teams($this->sendRequest('GET', '/team')['teams']);
    }

    /**
     * @param int $teamId
     * @param int $userId
     * @return mixed
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getUser(int $teamId, int $userId)
    {
        return $this->sendRequest('POST', sprintf('/team/%d/user/%d', $teamId, $userId));
    }

    /**
     * @param int $teamId
     * @param bool $archived
     * @return Spaces
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getSpaces(int $teamId, bool $archived = false) : Spaces
    {
        return new Spaces($this->sendRequest('GET', sprintf('/team/%d/space?archived=%s', $teamId, $archived ? 'true' : 'false'))['spaces']);
    }

    /**
     * @param int $spaceId
     * @return Space
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getSpace(int $spaceId) : Space
    {
        return new Space($this->sendRequest('GET', sprintf('/space/%d', $spaceId)));
    }

    /**
     * @param int $spaceId
     * @param bool $archived
     * @return Folders
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getFolders(int $spaceId, bool $archived = false) : Folders
    {
        return new Folders($this->sendRequest('GET', sprintf('/space/%d/folder?archived=%s', $spaceId, $archived ? 'true' : 'false'))['folders']);
    }

    /**
     * @param int $spaceId
     * @return Folder
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getFolder(int $spaceId) : Folder
    {
        return new Folder($this->sendRequest('GET', sprintf('/space/%d/folder', $spaceId)));
    }

    /**
     * @param int $folderId
     * @return Lists
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getLists(int $folderId) : Lists
    {
        return new Lists($this->sendRequest('GET', sprintf('/folder/%d/list', $folderId))['lists']);
    }

    /**
     * @param string $taskId
     * @param bool $customTaskIds
     * @param int|null $teamId
     * @return TrackedTimeWithIntervals
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getTrackingTimeWithIntervals(string $taskId, bool $customTaskIds = false, int $teamId = null) : TrackedTimeWithIntervals
    {
        return new TrackedTimeWithIntervals($this->sendRequest('GET', sprintf('/task/%s/time/%s',
            $taskId,
            $customTaskIds && $teamId ? "custom_task_ids=true&team_id={$teamId}" : '')
        )['data']);
    }

    /**
     * @param int $listId
     * @param array $filterParams
     * @return Tasks
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getTasks(int $listId, array $filterParams = []) : Tasks
    {
        return new Tasks($this->sendRequest('GET', sprintf('/list/%d/task?%s', $listId, http_build_query($filterParams)))['tasks']);
    }

    /**
     * Получает лист (в терминологии ClickUp'a) по его ID
     * @param int $listId
     * @return ListEntity
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getListById(int $listId) : ListEntity
    {
        return new ListEntity($this->sendRequest('GET', sprintf('/list/%d', $listId)));
    }

    /**
     * @note DONT WORK
     * @param int $teamId
     * @param array $filterParams
     * @return Tasks
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getTasksByTeamId(int $teamId, array $filterParams = []) : Tasks
    {
        return new Tasks($this->sendRequest('GET', sprintf('/team/%d/task?%s', $teamId, http_build_query($filterParams)))['tasks']);
    }


    /**
     * Возвращает коллекцию тасков из указанного диапазона
     * @param string $startDataTimestamp
     * @param string $endDateTimestamp
     * @param int $teamId
     * @return TimeCollection
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getTasksByTimeRange(string $startDataTimestamp, string $endDateTimestamp, int $teamId)
    {
        return new TimeCollection(
            $this->sendRequest('GET', sprintf('/team/%d/time_entries?start_date=%s&end_date=%s',
                $teamId,
                $startDataTimestamp * 1000,
                $endDateTimestamp * 1000
            ))['data']
        );
    }

    /**
     * Возвращает таск по его ID
     * @param string $taskId
     * @return Task
     * @throws GuzzleException
     * @throws \HttpInvalidParamException
     */
    public function getTask(string $taskId) : Task
    {
        return new Task($this->sendRequest('GET', sprintf('/task/%s/', $taskId)));
    }
}