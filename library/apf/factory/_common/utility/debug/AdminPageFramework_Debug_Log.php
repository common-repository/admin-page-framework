<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

class AdminPageFramework_Debug_Log extends AdminPageFramework_Debug_Base {
    protected static function _log($mValue, $sFilePath=null, $bStackTrace=false, $iTrace=0, $iStringLengthLimit=99999, $iArrayDepthLimit=50)
    {
        static $_fPreviousTimeStamp = 0;
        $_oCallerInfo = debug_backtrace();
        $_sCallerFunction = self::___getCallerFunctionName($_oCallerInfo, $iTrace);
        $_sCallerClass = self::___getCallerClassName($_oCallerInfo, $iTrace);
        $_fCurrentTimeStamp = microtime(true);
        $_sLogContent = self::___getLogContents($mValue, $_fCurrentTimeStamp, $_fPreviousTimeStamp, $_sCallerClass, $_sCallerFunction, $iStringLengthLimit, $iArrayDepthLimit) . ($bStackTrace ? self::getStackTrace($iTrace + 1) : '') . PHP_EOL;
        file_put_contents(self::___getLogFilePath($sFilePath, $_sCallerClass), $_sLogContent, FILE_APPEND);
        $_fPreviousTimeStamp = $_fCurrentTimeStamp;
    }
    private static function ___getLogContents($mValue, $_fCurrentTimeStamp, $_fPreviousTimeStamp, $_sCallerClass, $_sCallerFunction, $iStringLengthLimit, $iArrayDepthLimit)
    {
        return self::___getLogHeadingLine($_fCurrentTimeStamp, round($_fCurrentTimeStamp - $_fPreviousTimeStamp, 3), $_sCallerClass, $_sCallerFunction) . PHP_EOL . self::_getLegibleDetails($mValue, $iStringLengthLimit, $iArrayDepthLimit) . PHP_EOL;
    }
    private static function ___getCallerFunctionName($oCallerInfo, $iTrace)
    {
        return self::getElement($oCallerInfo, array( 2 + $iTrace, 'function' ), '');
    }
    private static function ___getCallerClassName($oCallerInfo, $iTrace)
    {
        return self::getElement($oCallerInfo, array( 2 + $iTrace, 'class' ), '');
    }
    private static function ___getLogFilePath($bsFilePathOrName, $sCallerClass)
    {
        $_sWPContentDir = WP_CONTENT_DIR . DIRECTORY_SEPARATOR;
        if (is_string($bsFilePathOrName) && ! self::hasSlash($bsFilePathOrName)) {
            return $_sWPContentDir . $bsFilePathOrName . '_' . date("Ymd") . '.log';
        }
        $_bFileExists = self::___createFile($bsFilePathOrName);
        if ($_bFileExists) {
            return $bsFilePathOrName;
        }
        $_sClassBaseName = $sCallerClass ? basename($sCallerClass) : basename(get_class());
        return $_sWPContentDir . $_sClassBaseName . '_' . date("Ymd") . '.log';
    }
    private static function ___createFile($sFilePath)
    {
        if (! $sFilePath || true === $sFilePath) {
            return false;
        }
        if (file_exists($sFilePath)) {
            return true;
        }
        $_bhResource = fopen($sFilePath, 'w');
        return ( boolean ) $_bhResource;
    }
    private static function ___getLogHeadingLine($fCurrentTimeStamp, $nElapsed, $sCallerClass, $sCallerFunction)
    {
        $_nNow = $fCurrentTimeStamp + (self::___getSiteGMTOffset() * 60 * 60);
        $_nMicroseconds = str_pad(round(($_nNow - floor($_nNow)) * 10000), 4, '0');
        $_aOutput = array( date("Y/m/d H:i:s", $_nNow) . '.' . $_nMicroseconds, self::___getFormattedElapsedTime($nElapsed), self::___getPageLoadID(), self::getFrameworkVersion(), $sCallerClass . '::' . $sCallerFunction, current_filter(), self::getCurrentURL(), );
        return implode(' ', $_aOutput);
    }
    private static function ___getSiteGMTOffset()
    {
        static $_nGMTOffset;
        $_nGMTOffset = isset($_nGMTOffset) ? $_nGMTOffset : get_option('gmt_offset');
        return $_nGMTOffset;
    }
    private static function ___getPageLoadID()
    {
        static $_sPageLoadID;
        $_sPageLoadID = $_sPageLoadID ? $_sPageLoadID : uniqid();
        return $_sPageLoadID;
    }
    private static function ___getFormattedElapsedTime($nElapsed)
    {
        $_aElapsedParts = explode(".", ( string ) $nElapsed);
        $_sElapsedFloat = str_pad(self::getElement($_aElapsedParts, 1, 0), 3, '0');
        $_sElapsed = self::getElement($_aElapsedParts, 0, 0);
        $_sElapsed = strlen($_sElapsed) > 1 ? '+' . substr($_sElapsed, -1, 2) : ' ' . $_sElapsed;
        return $_sElapsed . '.' . $_sElapsedFloat;
    }
}
