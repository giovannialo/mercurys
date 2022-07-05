<?php

namespace Source\Api;

use Source\Models\ChannelModel;

class ChannelApi extends Api
{
    /**
     * @return void
     */
    public function index(): void
    {
        $channels = (new ChannelModel())->select('id, nome')->fetch(true);
        echo json_encode(array_map(fn($channel) => $channel->data(), $channels));
    }

    /**
     * @param array $data
     * @return void
     */
    public function show(array $data): void
    {
        $id = preg_replace('/\D/', '', ($data['id'] ?? null));

        if (!$id) {
            $this->notFound();
        }

        $channel = (new ChannelModel())->select('id, nome')->where('id = :id', "id={$id}")->fetch();
        echo json_encode($channel->data());
    }
}