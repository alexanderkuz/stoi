<?php
/**
 * Date: 20.01.14
 * Time: 13:26
 */

namespace mihaildev\elfinder;

use mihaildev\elfinder\volume\Local;
use Yii;
use yii\helpers\ArrayHelper;



/**
 * Class Controller
 * @package mihaildev\elfinder
 * @property array $options
 */


class Controller extends BaseController{
	public $roots = [];
	public $disabledCommands = ['netmount'];
	public $watermark;

	private $_options;

	public function getOptions()
	{
		if($this->_options !== null)
			return $this->_options;

		$this->_options['roots'] = [];

		foreach($this->roots as $key=>$root){
			if(is_string($root))
				$root = ['path' => $root];

			if(!isset($root['class']))
				$root['class'] = Local::className();

			$root = Yii::createObject($root);

			/** @var \mihaildev\elfinder\volume\Local $root*/

			if($root->isAvailable())
			{
				$this->_options['roots'][$key] = $root->getRoot();
				$this->_options['roots'][$key]['plugin']['AutoResize'] = [
					'enable'         => true,       // For control by volume driver
					'maxWidth'       => 1024,       // Path to Water mark image
					'maxHeight'      => 1024,       // Margin right pixel
					'quality'        => 75,         // JPEG image save quality

						'preserveExif'   => false,      // Preserve EXIF data (Imagick only)
 				'forceEffect'    => false,      // For change quality of small images
					'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP // Target image formats ( bit-field )
				];
			}
		}

		$this->_options['bind']['upload.presave'] []= 'Plugin.AutoResize.onUpLoadPreSave';

		if(!empty($this->watermark)){
			$this->_options['bind']['upload.presave'][] = 'Plugin.Watermark.onUpLoadPreSave';

			if(is_string($this->watermark)){
				$watermark = [
					'source' => $this->watermark
				];
			}else{
				$watermark = $this->watermark;
			}

			$this->_options['plugin']['Watermark'] = $watermark;
		}

		$this->_options = ArrayHelper::merge($this->_options, $this->connectOptions);

		return $this->_options;
	}
}
