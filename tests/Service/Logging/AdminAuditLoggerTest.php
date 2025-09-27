<?php

namespace App\Test\Service\Logging;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use PHPUnit\Framework\TestCase;
use App\Service\Logging\AdminAuditLogger;

class AdminAuditLoggerTest extends TestCase {


    public function test_log_admin_creation_work(){
        // Arrange
        $user=new User();
        $user->setRoles(["ROLE_ADMIN"]);
        $mockLogger=$this->createMock( LoggerInterface::class);
        $logger_service= new AdminAuditLogger($mockLogger);

        // Acte
        $sut=$logger_service->logAdminCreation($user);


        // Assert
        $this->assertEquals($sut, true);

    }

}