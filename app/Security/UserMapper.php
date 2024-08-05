<?php declare(strict_types=1);

namespace App\Security;

use Nextras\Orm\Mapper\Dbal\DbalMapper;

/**
 * @extends DbalMapper<User>
 */
class UserMapper extends DbalMapper
{
    protected $tableName = 'user';

}