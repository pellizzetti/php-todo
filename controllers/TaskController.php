<?php

class TaskController
{
    public function handleRequest()
    {

        $req = isset($_GET['op']) ? $_GET['op'] : null;

        try {

            if (!$req || $req == 'list') {
                $this->listContacts();
            } elseif ($req == 'new') {
                $this->saveContact();
            } elseif ($req == 'delete') {
                $this->deleteContact();
            } elseif ($req == 'show') {
                $this->showContact();
            } else {
                $this->showError("Page not found", "Page for operation " . $req . " was not found!");
            }

        } catch (Exception $e) {
            $this->showError("Application error", $e->getMessage());
        }

    }
}
