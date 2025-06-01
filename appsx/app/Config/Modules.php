<?php

namespace Config;

use CodeIgniter\Modules\Modules as BaseModules;

/**
 * Modules Configuration file.
 *
 * NOTE: This class is required prior to Autoloader instantiation,
 * and does not extend BaseConfig.
 *
 * @immutable
 */
class Modules extends BaseModules
{
    /**
     * --------------------------------------------------------------------------
     * Enable Auto-Discovery?
     * --------------------------------------------------------------------------
     *
     * If true, then auto-discovery will happen across all elements listed in
     * $activeExplorers below. If false, no auto-discovery will happen at all,
     * giving a slight performance boost.
     */
    public $enabled = true;

    /**
     * --------------------------------------------------------------------------
     * Enable Auto-Discovery Within Composer Packages?
     * --------------------------------------------------------------------------
     *
     * If true, then auto-discovery will happen across all namespaces loaded
     * by Composer, as well. This include (but is not limited to) CodeIgniter,
     * any add-on modules, such as:
     *  - codeigniter4/shield
     *  - codeigniter4/settings
     */
    public $discoverInComposer = true;

    /**
     * --------------------------------------------------------------------------
     * Auto-Discovery Rules
     * --------------------------------------------------------------------------
     *
     * Aliases list, used by the auto-discovery feature.
     * - key: alias name (lowercase)
     * - value: full qualified name
     */
    public $aliases = [
        // 'toolbar' => \CodeIgniter\Debug\Toolbar::class,
    ];

    /**
     * --------------------------------------------------------------------------
     * Auto-Discovery Within Application Namespace?
     * --------------------------------------------------------------------------
     *
     * If true, then auto-discovery will happen across all sub-namespaces of
     * APP_NAMESPACE that are present. If false, auto-discovery will only happen
     * across the base APP_NAMESPACE, giving a performance boost if you have
     * large numbers of modules but rarely change namespace locations.
     */
    public $discoverInApp = true;
}