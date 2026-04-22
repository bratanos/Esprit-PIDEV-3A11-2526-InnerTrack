<?php

namespace Symfony\Config;

require_once __DIR__.\DIRECTORY_SEPARATOR.'KnpSnappy'.\DIRECTORY_SEPARATOR.'PdfConfig.php';
require_once __DIR__.\DIRECTORY_SEPARATOR.'KnpSnappy'.\DIRECTORY_SEPARATOR.'ImageConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class KnpSnappyConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $temporaryFolder;
    private $processTimeout;
    private $pdf;
    private $image;
    private $_usedProperties = [];
    
    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function temporaryFolder($value): static
    {
        $this->_usedProperties['temporaryFolder'] = true;
        $this->temporaryFolder = $value;
    
        return $this;
    }
    
    /**
     * Generator process timeout in seconds.
     * @default null
     * @param ParamConfigurator|int $value
     * @return $this
     */
    public function processTimeout($value): static
    {
        $this->_usedProperties['processTimeout'] = true;
        $this->processTimeout = $value;
    
        return $this;
    }
    
    /**
     * @default {"enabled":true,"binary":"wkhtmltopdf","options":[],"env":[]}
    */
    public function pdf(array $value = []): \Symfony\Config\KnpSnappy\PdfConfig
    {
        if (null === $this->pdf) {
            $this->_usedProperties['pdf'] = true;
            $this->pdf = new \Symfony\Config\KnpSnappy\PdfConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "pdf()" has already been initialized. You cannot pass values the second time you call pdf().');
        }
    
        return $this->pdf;
    }
    
    /**
     * @default {"enabled":true,"binary":"wkhtmltoimage","options":[],"env":[]}
    */
    public function image(array $value = []): \Symfony\Config\KnpSnappy\ImageConfig
    {
        if (null === $this->image) {
            $this->_usedProperties['image'] = true;
            $this->image = new \Symfony\Config\KnpSnappy\ImageConfig($value);
        } elseif (0 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "image()" has already been initialized. You cannot pass values the second time you call image().');
        }
    
        return $this->image;
    }
    
    public function getExtensionAlias(): string
    {
        return 'knp_snappy';
    }
    
    public function __construct(array $value = [])
    {
        if (array_key_exists('temporary_folder', $value)) {
            $this->_usedProperties['temporaryFolder'] = true;
            $this->temporaryFolder = $value['temporary_folder'];
            unset($value['temporary_folder']);
        }
    
        if (array_key_exists('process_timeout', $value)) {
            $this->_usedProperties['processTimeout'] = true;
            $this->processTimeout = $value['process_timeout'];
            unset($value['process_timeout']);
        }
    
        if (array_key_exists('pdf', $value)) {
            $this->_usedProperties['pdf'] = true;
            $this->pdf = new \Symfony\Config\KnpSnappy\PdfConfig($value['pdf']);
            unset($value['pdf']);
        }
    
        if (array_key_exists('image', $value)) {
            $this->_usedProperties['image'] = true;
            $this->image = new \Symfony\Config\KnpSnappy\ImageConfig($value['image']);
            unset($value['image']);
        }
    
        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }
    
    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['temporaryFolder'])) {
            $output['temporary_folder'] = $this->temporaryFolder;
        }
        if (isset($this->_usedProperties['processTimeout'])) {
            $output['process_timeout'] = $this->processTimeout;
        }
        if (isset($this->_usedProperties['pdf'])) {
            $output['pdf'] = $this->pdf->toArray();
        }
        if (isset($this->_usedProperties['image'])) {
            $output['image'] = $this->image->toArray();
        }
    
        return $output;
    }

}
