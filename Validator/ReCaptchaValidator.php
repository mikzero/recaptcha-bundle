<?php
/*
* This file is part of the DSReCaptcha Component.
*
* (c) Ilya Pokamestov
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace PV\RecaptchaBundle\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

/**
 * ReCaptcha Validator.
 *
 * (@author Ilya Pokamestov <dario_swain@yahoo.com>)
 * @author Pierre Vassoilles <pierre.vassoilles@gmail.com>
 */
class ReCaptchaValidator extends ConstraintValidator
{
    /** @var Request */
    protected $request;
    /** @var  string */
    protected $privateKey;
    /** @var string */

    /**
     * @param Request $request
     * @param string  $privateKey
     */
    public function __construct(Request $request, $privateKey)
    {
        $this->request = $request;
        $this->privateKey = $privateKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {

        if (!($constraint instanceof ReCaptchaConstraint)) {
            throw new InvalidArgumentException('Use ReCaptchaConstraint for ReCaptchaValidator.');
        }

        if ($this->request->get('g-recaptcha-response', false)) {

            $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $this->privateKey . "&response=" . $this->request->get('g-recaptcha-response', false) . "&remoteip=" . $this->request->getClientIp()));

            if (!$response->success) {
                $this->context->addViolationAt('recaptcha', $constraint->message);
            }
        } else {
            $this->context->addViolationAt('recaptcha', $constraint->message);
        }
    }
}
