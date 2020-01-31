<?php

declare(strict_types=1);

namespace MsgPhp\User\Infra\Console\Command;

use MsgPhp\Domain\Factory\DomainObjectFactoryInterface;
use MsgPhp\Domain\Infra\Console\Context\ContextFactoryInterface;
use MsgPhp\Domain\Message\{DomainMessageBusInterface, MessageDispatchingTrait, MessageReceivingInterface};
use MsgPhp\User\Command\CreateUserCommand as CreateUserDomainCommand;
use MsgPhp\User\Event\UserCreatedEvent;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class CreateUserCommand extends Command implements MessageReceivingInterface
{
    use MessageDispatchingTrait;

    protected static $defaultName = 'user:create';

    private $contextFactory;

    /** @var StyleInterface */
    private $io;

    public function __construct(DomainObjectFactoryInterface $factory, DomainMessageBusInterface $bus, ContextFactoryInterface $contextFactory)
    {
        $this->factory = $factory;
        $this->bus = $bus;
        $this->contextFactory = $contextFactory;

        parent::__construct();
    }

    /**
     * @internal
     */
    public function onMessageReceived($message): void
    {
        if ($message instanceof UserCreatedEvent) {
            $this->io->success('Created user '.$message->user->getCredential()->getUsername());
        }
    }

    protected function configure(): void
    {
        $this->setDescription('Create a user');
        $this->contextFactory->configure($this->getDefinition());
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = new SymfonyStyle($input, $output);
        $context = $this->contextFactory->getContext($input, $this->io);

        $this->dispatch(CreateUserDomainCommand::class, [$context]);

        return 0;
    }
}
