<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UserValidationTest
 * 
 * Technical Explanation for the Professor:
 * This is a UNIT TEST. Its purpose is to validate the business logic (constraints) 
 * defined in the User entity without requiring a database or a web server.
 * 
 * We use the Symfony Validator service to check if the entity satisfies the 
 * #[Assert] attributes. This ensures that:
 * 1. Mandatory fields (email) are not empty.
 * 2. Formats (Email) are correctly followed.
 */
class UserValidationTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        // Boot the Symfony kernel to access the validator service
        self::bootKernel();
        $this->validator = self::getContainer()->get(ValidatorInterface::class);
    }

    /**
     * Test that a valid user passes validation.
     */
    public function testValidUser(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $user->setPassword('password123');
        $user->setFirstName('John');
        $user->setLastName('Doe');

        // Validate the entity
        $errors = $this->validator->validate($user);

        // Check that there are 0 errors
        $this->assertCount(0, $errors, 'A valid user should not have validation errors.');
    }

    /**
     * Test that an invalid email triggers a validation error.
     */
    public function testInvalidEmail(): void
    {
        $user = new User();
        $user->setEmail('invalid-email'); // Missing @ and domain
        $user->setPassword('password123');

        $errors = $this->validator->validate($user);

        // We expect at least 1 error on the 'email' property
        $this->assertGreaterThan(0, count($errors), 'An invalid email should trigger a validation error.');
        $this->assertEquals('email', $errors[0]->getPropertyPath());
    }

    /**
     * Test that a blank email triggers a validation error.
     */
    public function testBlankEmail(): void
    {
        $user = new User();
        $user->setEmail(''); // Empty email

        $errors = $this->validator->validate($user);

        $this->assertGreaterThan(0, count($errors), 'A blank email should trigger a validation error.');
    }
}
