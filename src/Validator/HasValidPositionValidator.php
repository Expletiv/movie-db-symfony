<?php

namespace App\Validator;

use App\Entity\Interface\Sortable;
use App\Validator\Constraints\HasValidPosition;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Contracts\Translation\TranslatorInterface;

class HasValidPositionValidator extends ConstraintValidator
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof HasValidPosition) {
            throw new UnexpectedTypeException($constraint, HasValidPosition::class);
        }

        if (!$value instanceof Sortable) {
            throw new UnexpectedValueException($value, Sortable::class);
        }

        $maxPosition = $this->getMaxPosition($value);

        $positionIsTooHigh = null !== $maxPosition && $value->getPosition() > $maxPosition;

        if ($value->getPosition() < -1 || $positionIsTooHigh) {
            $message = $this->translator->trans(
                $constraint->message,
                [
                    'value' => $value->getPosition(),
                    'min' => -1,
                    'max' => $maxPosition ?? 'unknown',
                ],
                'validators'
            );

            $this->context->buildViolation($message)->addViolation();
        }
    }

    private function getMaxPosition(Sortable $sortable): ?int
    {
        $repository = $this->entityManager->getRepository($sortable::class);

        $groupName = $sortable->getSortableGroupName();
        $group = $sortable->getSortableGroup();

        if (null === $groupName || null === $group) {
            return null;
        }

        return $repository->count([$groupName => $group]);
    }
}
