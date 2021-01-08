<?php
namespace App\Service;

use App\Repository\UserRepository;
use App\Repository\CommandRepository;

class OrderService {

    private $users;
    private $commands;

    public function __construct(UserRepository $users, CommandRepository $commands) {
        $this->users = $users;
        $this->commands = $commands;
    }

    // TODO: admin panel
    public function findAllCommandsToValidate() {
        return $this->commands->findBy(array('statut' => 'En attente'));
    }

    public function getOrdersByUserId($id){
        return $this->users->find($id)->getCommands();
    }

}
