<?php

if (!function_exists('version')) {
		/**
     * Display version numbers.
     *
     * @param string  $format
		 * @return string
		 */
		function version($format = 'compact')
		{
				switch ($format) {
						case 'compact':
								$version = 
										config('version.major').'.'.config('version.minor').'.'.config('version.patch');
								if (config('version.build') !== false) {
										$version .= '-'.config('version.build');
								}
								if (config('version.commit') !== false) {
										$version .= '-'.config('version.commit');
								}
								break;
						case 'full':
								$version = 'version ' .
										config('version.major').'.'.config('version.minor').'.'.config('version.patch');

								if (config('version.build') !== false) {
										$version .= ' (build: '.config('version.build').')';
								}
								if (config('version.commit') !== false) {
										$version .= ' (commit: '.config('version.commit').')';
								}
								break;
				}

				return $version;
		}
}
// vim: tabstop=4 shiftwidth=4 expandtab
