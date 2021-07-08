<?php

namespace App\Model;

/**
 * Classe de modèle qui représente les oiseaux
 */
class BirdModel
{
    private $birds = [
        [
            'name' => 'White bird',
            'description' => 'The chubby white bird drops an egg bomb when players tap the screen after launching the creature from the slingshot.',
            'image' => 'white.png',
        ],
        [
            'name' => 'Black bird',
            'description' => 'Black birds act as bombs, which explode once they\'ve landed on a target, obliterating pigs and buildings around them.',
            'image' => 'black.png',
        ],
        [
            'name' => 'Red bird',
            'description' => 'The first avian missile players encounter when they start the game, the red bird follows a simple trajectory when launched.',
            'image' => 'red.png',
        ],
        [
            'name' => 'Blue bird',
            'description' => 'The blue bird splits into three smaller versions in mid-air when the screen is tapped.',
            'image' => 'blue.png',
        ],
        [
            'name' => 'Yellow bird',
            'description' => 'Tapping the screen after launching the yellow bird gives the critter a speed boost that makes it more deadly.',
            'image' => 'yellow.png',
        ],
        [
            'name' => 'Green bird',
            'description' => 'The green bird turns into a boomerang that doubles back to strike targets in otherwise protected locations.',
            'image' => 'green.png',
        ],
        [
            'name' => 'Big red bird',
            'description' => 'The big red bird is a flying wrecking bail that causes more damage than his smaller red cousin.',
            'image' => 'red-big.png',
        ],
    ];

    /**
     * Get all birds
     */
    public function getBirds()
    {
        return $this->birds;
    }

    /**
     * Get bird by id
     * 
     * @param int $id Bird id
     * 
     * @return array|null Bird data
     */
    public function getBirdById(int $id): ?array
    {
        // /!\ C'est bien le rôle du Model de dire si la donnée existe ou non
        // L'oiseau demandé existe-t-il dans le tableau ?
        if ( !isset($this->birds[$id]) ) {
            // Retourne null
            return null;
        }

        // On retourne les infos de l'oiseau
        return $this->birds[$id];
    }

}