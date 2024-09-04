<?php

/**
 * Aplikasi
 *
 * @file /php
 * @author Muhammad Nizar | http://www.al-ayubi.com/
 * @email nizaraluk@gmail.com
 * @date 30 Maret 2017
*/

	class Ambil_url
	{

		private $_scriptfile;
	    public function ambilscriptfile()
	    {
	        if (isset($this->_scriptfile)) {
	            return $this->_scriptfile;
	        } elseif (isset($_SERVER['SCRIPT_FILENAME'])) {
	            return $_SERVER['SCRIPT_FILENAME'];
	        } else {
	            //throw new InvalidConfigException('Unable to determine the entry script file path.');
	            return $tampil = 'Unable to determine the entry script file path.';
	        }
	    }

	    private $_scripturl;
	    public function ambilscripturl()
	    {
	        if ($this->_scripturl === null) {
	            $scriptfile = $this->ambilscriptfile();
	            $scriptname = basename($scriptfile);
	            if (isset($_SERVER['SCRIPT_NAME']) && basename($_SERVER['SCRIPT_NAME']) === $scriptname) {
	                $this->_scripturl = $_SERVER['SCRIPT_NAME'];
	            } elseif (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) === $scriptname) {
	                $this->_scriptUrl = $_SERVER['PHP_SELF'];
	            } elseif (isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $scriptname) {
	                $this->_scripturl = $_SERVER['ORIG_SCRIPT_NAME'];
	            } elseif (isset($_SERVER['PHP_SELF']) && ($pos = strpos($_SERVER['PHP_SELF'], '/' . $scriptname)) !== false) {
	                $this->_scripturl = substr($_SERVER['SCRIPT_NAME'], 0, $pos) . '/' . $scriptname;
	            } elseif (!empty($_SERVER['DOCUMENT_ROOT']) && strpos($scriptFile, $_SERVER['DOCUMENT_ROOT']) === 0) {
	                $this->_scripturl = str_replace('\\', '/', str_replace($_SERVER['DOCUMENT_ROOT'], '', $scriptfile));
	            } else {
	                //throw new InvalidConfigException('Unable to determine the entry script URL.');
	                $this->_scripturl = 'Unable to determine the entry script URL.';
	            }
	        }

	        return $this->_scriptUrl;
	    }


	    private $_baseurl;
	    public function ambilbaseurl()
	    {
	        if ($this->_baseurl === null) {
	            $this->_baseurl = rtrim(dirname($this->ambilscripturl()), '\\/');
	        }

	        return $this->_baseurl;
	    }

	    private $_url;
	    public function ambilurl()
	    {
	        if ($this->_url === null) {
	            $this->_url = $this->resolverequesturi();
	        }

	        return $this->_url;
	    }

	    public function seturl($value)
	    {
	        $this->_url = $value;
	    }

	    protected function resolverequesturi()
	    {
	        if (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // IIS
	            $requesturi = $_SERVER['HTTP_X_REWRITE_URL'];
	        } elseif (isset($_SERVER['REQUEST_URI'])) {
	            $requesturi = $_SERVER['REQUEST_URI'];
	            if ($requesturi !== '' && $requesturi[0] !== '/') {
	                $requesturi = preg_replace('/^(http|https):\/\/[^\/]+/i', '', $requesturi);
	            }
	        } elseif (isset($_SERVER['ORIG_PATH_INFO'])) { // IIS 5.0 CGI
	            $requesturi = $_SERVER['ORIG_PATH_INFO'];
	            if (!empty($_SERVER['QUERY_STRING'])) {
	                $requesturi .= '?' . $_SERVER['QUERY_STRING'];
	            }
	        } else {
	            //throw new InvalidConfigException('Unable to determine the request URI.');
	            $requesturi = 'Unable to determine the request URI.';
	        }

	        return $requesturi;
	    }
	}

