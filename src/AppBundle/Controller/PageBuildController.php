<?php
/**
 * Created by PhpStorm.
 * User: toma4
 * Date: 18.01.2018
 * Time: 11:42
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Channel;
use AppBundle\Entity\Movie;
use Google_Client;
use Google_Service_YouTube;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PageBuildController extends Controller
{

    /**
     * @Route("/buildThisPage", name="cron_build_page")
     * @return Response
     */
    public function initCronAction(){
        $client = new Google_Client();
        $client->setApplicationName("ytBrot");
        $client->setDeveloperKey("AIzaSyAMrHXcrs7V8RpsvtVh74nMV5Jya8Ss86U");
        $service = new Google_Service_YouTube($client);

        $entityMenager = $this->getDoctrine()->getManager();
        $channels = $entityMenager->getRepository(Channel::class)->findAll();

        foreach ($channels as $channel) {
            $channelId = $this->searchChannelIdByName($service, 'snippet', array('maxResults' => 1, 'q' => $channel->getName(), 'type' => 'channel'), $channel);
            $this->searchListByKeyword($service, 'snippet', array('maxResults' => 25, 'order' => "date", 'channelId' => $channelId, 'type' => 'video'), $channel);
        }

        return new Response(200);
    }

    private function searchChannelIdByName($service, $part, $params, Channel $channel){
        $params = array_filter($params);
        $response = $service->search->listSearch(
            $part,
            $params
        );

        $channel->setDescription($response['items'][0]['snippet']['description'])
            ->setThumbnail($response['items'][0]['snippet']['thumbnails']['default']['url']);
        $entityMenager = $this->getDoctrine()->getManager();
        $entityMenager->persist($channel); // ma zapisac obiekt
        $entityMenager->flush(); // wykonanie sql

        return $response['items'][0]['id']['channelId'];
    }

    private function searchListByKeyword($service, $part, $params, Channel $channel) {
        $params = array_filter($params);
        $response = $service->search->listSearch(
            $part,
            $params
        );

        $links = array();
        foreach($channel->getMovies() as $movie){
            $links[] = $movie->getLink();
        }

        foreach($response['items'] as $item){
            if(!in_array("https://www.youtube.com/embed/".$item['id']['videoId'], $links)){
                $movie = new Movie();
                $movie->setChannel($channel);
                $movie->setDescription($item['snippet']['description']);
                $movie->setLink("https://www.youtube.com/embed/".$item['id']['videoId']);
                $movie->setThumbnail($item['snippet']['thumbnails']['default']['url']);
                $movie->setName($item['snippet']['title']);
                $entityMenager = $this->getDoctrine()->getManager();
                $entityMenager->persist($movie); // ma zapisac obiekt
                $entityMenager->flush(); // wykonanie sql
            }
        }
    }
}