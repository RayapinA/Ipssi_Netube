<?php

namespace App\Command;

use App\Entity\User;

use App\Manager\UserManager;
use App\Manager\VideoManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class NumberVideoByCommand extends Command
{
    protected static $defaultName = 'app:number-video-by';
    private $userManager;
    private $videoManager;
    private $encoder;

    public function __construct(UserManager $userManager, UserPasswordEncoderInterface $encoder, VideoManager $videoManager){

        $this->userManager = $userManager;
        $this->videoManager = $videoManager;
        $this->encoder = $encoder;
        parent::__construct();

    }
    protected function configure()
    {
        $this
            ->setDescription('Command for count the number video for one user')
            ->addArgument('email', InputArgument::REQUIRED, 'user you are looking for')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');

        $io->note(sprintf('You passed an argument: %s', $email));

        $idUser = $this->userManager->getIdByEmail($email);
        if($idUser){
            $nbVideo = $this->videoManager->getVideosByUser($idUser);
            $io->success(sprintf('You have %s videos for this User',$nbVideo));

        }else{
            $io->error(sprintf('Error for this email: %s',$email));
        }

    }
}

