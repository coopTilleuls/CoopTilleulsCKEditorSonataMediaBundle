<?php

/*
 * This file is part of the CKEditorSonataMediaBundle package.
 *
 * (c) La Coopérative des Tilleuls <contact@les-tilleuls.coop>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoopTilleuls\Bundle\CKEditorSonataMediaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Kévin Dunglas <kevin@les-tilleuls.coop>
 */
class CoopTilleulsCKEditorSonataMediaBundle extends Bundle
{
    /**
     * Allows to extends the MediaAdmin controller.
     *
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'SonataMediaBundle';
    }
}
