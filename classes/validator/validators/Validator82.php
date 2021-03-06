<?php

namespace malkusch\bav;

/**
 * Copyright (C) 2006  Markus Malkusch <markus@malkusch.de>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 *
 * @package classes
 * @subpackage validator
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @copyright Copyright (C) 2006 Markus Malkusch
 */
class Validator82 extends Validator
{

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var Validator33
     */
    private $mode1;

    /**
     * @var Validator10
     */
    private $mode2;

    public function __construct(Bank $bank)
    {
        parent::__construct($bank);

        $this->mode1 = new Validator33($bank);
        $this->mode1->setWeights(array(2, 3, 4, 5, 6));

        $this->mode2 = new Validator10($bank);
    }

    protected function validate()
    {
        $this->validator = substr($this->account, 2, 2) == 99
                         ? $this->mode2
                         : $this->mode1;
    }

    /**
     * @return bool
     */
    protected function getResult()
    {
        return $this->validator->isValid($this->account);
    }
}
