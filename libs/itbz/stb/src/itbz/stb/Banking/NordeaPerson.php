<?php
/**
 * This file is part of the stb package
 *
 * Copyright (c) 2012 Hannes Forsgård
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Hannes Forsgård <hannes.forsgard@gmail.com>
 * @package stb\Banking
 */

namespace itbz\stb\Banking;

use itbz\stb\Utils\Modulo10;

/**
 * NordeaPerson account number validator
 *
 * @package stb\Banking
 */
class NordeaPerson extends AbstractAccount
{
    /**
     * Validate clearing number
     *
     * @param string $nr
     *
     * @return bool
     */
    public function isValidClearing($nr)
    {
        return $nr == 3300 ||  $nr == 3782;
    }

    /**
     * Validate account number structure
     *
     * @param string $nr
     *
     * @return bool
     */
    public function isValidStructure($nr)
    {
        return (boolean)preg_match("/^0{0,2}\d{10}$/", $nr);
    }

    /**
     * Validate check digit
     *
     * @param string $clearing
     * @param string $nr
     *
     * @return bool
     */
    public function isValidCheckDigit($clearing, $nr)
    {
        $nr = substr($nr, strlen($nr) - 10);
        $modulo = new Modulo10();

        return $modulo->verify($nr);
    }

    /**
     * Get string describing account type
     *
     * @return string
     */
    public function getType()
    {
        return "Nordea";
    }

    /**
     * Get account as string
     *
     * @param string $clearing
     * @param string $nr
     *
     * @return string
     */
    protected function tostring($clearing, $nr)
    {
        // Remove starting ceros if they exist
        $nr = substr($nr, strlen($nr) - 10);

        return "$clearing,$nr";
    }
}
