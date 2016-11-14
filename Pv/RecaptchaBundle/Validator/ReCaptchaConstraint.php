<?php
/*
* This file is part of the DSReCaptcha Component.
*
* (c) Ilya Pokamestov
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Pv\RecaptchaBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * ReCaptcha Constraint.
 *
 * (@author Ilya Pokamestov <dario_swain@yahoo.com>)
 * @author Pierre Vassoilles <pierre.vassoilles@gmail.com>
 */
class ReCaptchaConstraint extends Constraint
{
	/** @var string */
	public $message = 'Veuillez prouver que nous n\'êtes pas un robot';

	/** @return string */
	public function validatedBy()
	{
		return 'pv_recaptcha_validator';
	}
}