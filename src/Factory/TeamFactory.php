<?php

namespace App\Factory;

use App\Entity\Team;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Team>
 *
 * @method static Team|Proxy createOne(array $attributes = [])
 * @method static Team[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Team|Proxy find(object|array|mixed $criteria)
 * @method static Team|Proxy findOrCreate(array $attributes)
 * @method static Team|Proxy first(string $sortedField = 'id')
 * @method static Team|Proxy last(string $sortedField = 'id')
 * @method static Team|Proxy random(array $attributes = [])
 * @method static Team|Proxy randomOrCreate(array $attributes = [])
 * @method static Team[]|Proxy[] all()
 * @method static Team[]|Proxy[] findBy(array $attributes)
 * @method static Team[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Team[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RepositoryProxy repository()
 * @method Team|Proxy create(array|callable $attributes = [])
 */
class TeamFactory extends ModelFactory
{
    protected static function getClass(): string
    {
        return Team::class;
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->company(),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }
}
