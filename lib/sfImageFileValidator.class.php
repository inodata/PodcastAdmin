<?php

/**
 * sfImageFileValidator allows you to apply constraints to image file upload, it extend the sfFileValidator functions.
 *
 * @author     Kamil Adryjanek <kamil.adryjanek@gmail.com>
 */
class sfImageFileValidator extends sfValidatorFile
{
    /**
     * Configures the current validator.
     *
     * Available options:
     *
     *  * max_height:             The maximum file height in pixels
     *  * min_height:             The minimum file height in pixels
     *  * max_width:              The maximum file width in pixels
     *  * min_width:              The minimum file width in pixels
     *
     * Available error codes:
     *
     *  * max_height
     *  * min_height
     *  * max_width
     *  * min_width
     *
     * @param array $options   An array of options
     * @param array $messages  An array of error messages
     *
     * @see sfValidatorBase
     */
    public function configure($options = array(), $messages = array())
    {
        parent::configure($options, $messages);

        $this->addOption('max_height');
        $this->addOption('min_height');
        $this->addOption('max_width');
        $this->addOption('min_width');

        $this->addMessage('max_height', 'File is too high (maximum is %max_height% pixels, %height% given).');
        $this->addMessage('min_height', 'File is too short (minimum is %min_height% pixels, %height% given).');
        $this->addMessage('max_width', 'File is too wide (maximum is %max_width% pixels, %width% given).');
        $this->addMessage('min_width', 'File is too thin (minimum is %min_width% pixels, %width% given).');
    }

    /**
     * This validator always returns a sfValidatedFile object.
     *
     * The input value must be an array with the following keys:
     *
     *  * tmp_name: The absolute temporary path to the file
     *  * name:     The original file name (optional)
     *  * type:     The file content type (optional)
     *  * error:    The error code (optional)
     *  * size:     The file size in bytes (optional)
     *
     * @see sfValidatorBase
     */
    protected function doClean($value)
    {
        if (!is_array($value) || !isset($value['tmp_name'])) {
            throw new sfValidatorError($this, 'invalid', array('value' => (string) $value));
        }

        // get image dimensions
        list($width, $height) = getimagesize($value['tmp_name']);

        // check file height
        if ($this->hasOption('max_height') && $this->getOption('max_height') < (int) $height) {
            throw new sfValidatorError($this, 'max_height', array('max_height' => $this->getOption('max_height'), 'height' => (int) $height));
        }

        if ($this->hasOption('min_height') && $this->getOption('min_height') > (int) $height) {
            throw new sfValidatorError($this, 'min_height', array('min_height' => $this->getOption('min_height'), 'height' => (int) $height));
        }

        // check file width
        if ($this->hasOption('max_width') && $this->getOption('max_width') < (int) $width) {
            throw new sfValidatorError($this, 'max_width', array('max_width' => $this->getOption('max_width'), 'width' => (int) $width));
        }

        if ($this->hasOption('min_width') && $this->getOption('min_width') > (int) $width) {
            throw new sfValidatorError($this, 'min_width', array('min_width' => $this->getOption('min_width'), 'width' => (int) $width));
        }

        // check other options
        return parent::doClean($value);
    }
}
?>