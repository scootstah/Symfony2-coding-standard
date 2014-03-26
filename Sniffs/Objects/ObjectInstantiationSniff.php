<?php

class Symfony2_Sniffs_Objects_ObjectInstantiationSniff extends Squiz_Sniffs_Objects_ObjectInstantiationSniff
{
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        parent::process($phpcsFile, $stackPtr);

        $tokens = $phpcsFile->getTokens();

        $tokenAfterClass = $tokens[($stackPtr + 3)];

        // Make sure there is no spaces after the classname
        if ($tokenAfterClass['type'] == 'T_WHITESPACE') {
            $error = 'New Objects must not have whitespace after the classname';
            $phpcsFile->addError($error, $stackPtr+3, 'SpaceAfterClass');

        // Make sure there are parenthesis after the classname
        } elseif ($tokenAfterClass['type'] == 'T_SEMICOLON') {
            $error = 'New Objects must include parenthesis';
            $phpcsFile->addError($error, $stackPtr+3, 'MissingParenthesis');
        }
    }
}
