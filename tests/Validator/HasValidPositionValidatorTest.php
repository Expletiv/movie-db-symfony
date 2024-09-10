<?php

namespace App\Tests\Validator;

use App\Entity\Interface\Sortable;
use App\Tests\Mocks\SortableMock;
use App\Validator\Constraints\HasValidPosition;
use App\Validator\HasValidPositionValidator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Generator;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @extends ConstraintValidatorTestCase<HasValidPositionValidator>
 */
class HasValidPositionValidatorTest extends ConstraintValidatorTestCase
{
    /** @var EntityRepository<Sortable>&MockInterface */
    private EntityRepository&MockInterface $repository;
    private TranslatorInterface&MockInterface $translator;

    protected function createValidator(): ConstraintValidatorInterface
    {
        $entityManager = Mockery::mock(EntityManagerInterface::class);
        $this->repository = Mockery::mock(EntityRepository::class);
        $entityManager->shouldReceive('getRepository')->andReturn($this->repository);

        $this->translator = Mockery::mock(TranslatorInterface::class);

        return new HasValidPositionValidator($entityManager, $this->translator);
    }

    /**
     * @dataProvider validSortables
     */
    public function testValid(Sortable $sortable, int $totalItemCount = 0): void
    {
        $this->repository->shouldReceive('count')->andReturn($totalItemCount);

        $constraint = new HasValidPosition();
        $this->validator->validate($sortable, $constraint);
        $this->assertNoViolation();
    }

    /**
     * @dataProvider invalidSortables
     */
    public function testInvalid(Sortable $sortable, int $totalItemCount = 0): void
    {
        $this->repository->shouldReceive('count')->andReturn($totalItemCount);
        $this->translator->shouldReceive('trans')->andReturn('error message');

        $constraint = new HasValidPosition();
        $this->validator->validate($sortable, $constraint);
        $this->buildViolation('error message')->assertRaised();
    }

    public function validSortables(): Generator
    {
        yield [(new SortableMock())->setPosition(0)];
        yield [(new SortableMock())->setPosition(-1)];
        yield [(new SortableMock())->setPosition(1), 1];
        yield [(new SortableMock())->setPosition(2), 2];
        yield [(new SortableMock())->setPosition(39), 100];
    }

    public function invalidSortables(): Generator
    {
        yield [(new SortableMock())->setPosition(-2)];
        yield [(new SortableMock())->setPosition(-3)];
        yield [(new SortableMock())->setPosition(1)];
        yield [(new SortableMock())->setPosition(-23), 100];
        yield [(new SortableMock())->setPosition(101), 100];
    }
}
