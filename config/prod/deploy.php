<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('hansk@localhost')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/var/www/html/portalPlus')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@github.com:hansKapser/portalplus.git')
            // the repository branch to deploy
            ->repositoryBranch('master')
        ;
    }
    
    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        $this->log('Checking that the repository is in a clean state.');
        $this->runLocal('git diff --quiet');

        $this->log('Preparing the app');
        $this->runLocal('rm -fr ./var/cache/*');
        $this->runLocal('SYMFONY_ENV=prod ./bin/console assets:install web/');
        //$this->runLocal('SYMFONY_ENV=prod ./bin/console lint:twig app/Resources/ --no-debug');
        //$this->runLocal('yarn install');
        //$this->runLocal('NODE_ENV=production ./node_modules/.bin/webpack --progress');
        $this->runLocal('composer dump-autoload --optimize');        // $this->runLocal('./vendor/bin/simple-phpunit');
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        // $this->runRemote('{{ console_bin }} app:my-task-name');
        // $this->runLocal('say "The deployment has finished."');
    }
};
