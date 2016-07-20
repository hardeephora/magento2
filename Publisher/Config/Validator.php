<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\MessageQueue\Publisher\Config;

/**
 * Publisher config data validator.
 */
class Validator implements ValidatorInterface
{
    /**
     * Config validator list.
     *
     * @var ValidatorInterface[]
     */
    private $validators;

    /**
     * Validator constructor.
     * @param ValidatorInterface[] $validators
     */
    public function __construct($validators)
    {
        $this->validators = $validators;
    }

    /**
     * Validate merged publisher config data.
     *
     * @param array $configData
     * @throws \LogicException
     * @return void
     */
    public function validate($configData)
    {
        foreach ($this->validators as $validator) {
            if (!$validator instanceof ValidatorInterface) {
                throw new \LogicException(
                    'Validator does not implements Magento\Framework\MessageQueue\Publisher\Config\ValidatorInterface'
                );
            }
            $validator->validate($configData);
        }
    }
}
