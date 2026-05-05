<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testDefaultStatusIsPending(): void
    {
        $this->assertSame('PENDING', $this->user->getStatus());
    }

    public function testDefaultIsVerifiedFalse(): void
    {
        $this->assertFalse($this->user->isVerified());
    }

    public function testCreatedAtIsSetOnConstruct(): void
    {
        $this->assertNotNull($this->user->getCreatedAt());
    }

    public function testGetRolesAlwaysIncludesRoleUser(): void
    {
        $this->user->setRoles([]);
        $this->assertContains('ROLE_USER', $this->user->getRoles());
    }

    public function testGetRolesMergesCustomRoleWithRoleUser(): void
    {
        $this->user->setRoles(['ROLE_ADMIN']);
        $roles = $this->user->getRoles();
        $this->assertContains('ROLE_USER', $roles);
        $this->assertContains('ROLE_ADMIN', $roles);
    }

    public function testGetRolesDeduplicatesRoleUser(): void
    {
        $this->user->setRoles(['ROLE_USER', 'ROLE_USER']);
        $roles = $this->user->getRoles();
        $this->assertCount(1, array_filter($roles, fn($r) => $r === 'ROLE_USER'));
    }

    public function testGetPrimaryRoleReturnsNonUserRole(): void
    {
        $this->user->setRoles(['ROLE_THERAPIST']);
        $this->assertSame('ROLE_THERAPIST', $this->user->getPrimaryRole());
    }

    public function testGetPrimaryRoleDefaultsToRoleUserWhenNoneSet(): void
    {
        $this->user->setRoles([]);
        $this->assertSame('ROLE_USER', $this->user->getPrimaryRole());
    }

    public function testGetFullNameCombinesFirstAndLastName(): void
    {
        $this->user->setFirstName('John');
        $this->user->setLastName('Doe');
        $this->assertSame('John Doe', $this->user->getFullName());
    }

    public function testGetFullNameWithNullFirstName(): void
    {
        $this->user->setFirstName(null);
        $this->user->setLastName('Doe');
        $this->assertSame('Doe', $this->user->getFullName());
    }

    public function testGetFullNameWithNullLastName(): void
    {
        $this->user->setFirstName('John');
        $this->user->setLastName(null);
        $this->assertSame('John', $this->user->getFullName());
    }

    public function testGetFullNameReturnEmptyStringWhenBothNull(): void
    {
        $this->user->setFirstName(null);
        $this->user->setLastName(null);
        $this->assertSame('', $this->user->getFullName());
    }

    public function testGetProfilePictureUrlReturnsNullWhenNoProfilePicture(): void
    {
        $this->assertNull($this->user->getProfilePictureUrl());
    }

    public function testGetProfilePictureUrlReturnsHttpUrlUnchanged(): void
    {
        $this->user->setProfilePicture('https://example.com/photo.jpg');
        $this->assertSame('https://example.com/photo.jpg', $this->user->getProfilePictureUrl());
    }

    public function testGetProfilePictureUrlReturnsRelativeUploadPathUnchanged(): void
    {
        $this->user->setProfilePicture('/uploads/profiles/photo.jpg');
        $this->assertSame('/uploads/profiles/photo.jpg', $this->user->getProfilePictureUrl());
    }

    public function testGetProfilePictureUrlExtractsFilenameFromAbsoluteWindowsPath(): void
    {
        $this->user->setProfilePicture('C:\\Users\\user\\Pictures\\photo.jpg');
        $this->assertSame('/uploads/profiles/photo.jpg', $this->user->getProfilePictureUrl());
    }

    public function testGetUserIdentifierReturnsEmail(): void
    {
        $this->user->setEmail('user@test.com');
        $this->assertSame('user@test.com', $this->user->getUserIdentifier());
    }

    public function testSetEmailReturnsSelf(): void
    {
        $result = $this->user->setEmail('test@example.com');
        $this->assertSame($this->user, $result);
    }

    public function testSetIsVerifiedReturnsSelf(): void
    {
        $result = $this->user->setIsVerified(true);
        $this->assertSame($this->user, $result);
        $this->assertTrue($this->user->isVerified());
    }

    public function testCodeCollectionIsInitializedOnConstruct(): void
    {
        $this->assertCount(0, $this->user->getCode());
    }
}
