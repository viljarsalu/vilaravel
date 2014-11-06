<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * handle missing method
	 *
	 * @param  int  $parameters
	 * @return Response
	 */
	public function missingMethod($parameters = array())
	{
	    return "missing method, 404";
	}

}
