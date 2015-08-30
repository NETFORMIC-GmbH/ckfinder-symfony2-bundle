<?php
/*
 * This file is a part of the CKFinder bundle for Symfony.
 *
 * Copyright (C) 2015, CKSource - Frederico Knabben. All rights reserved.
 *
 * Licensed under the terms of the MIT license.
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace CKSource\Bundle\CKFinderBundle\Test\Form\Type;

use CKSource\Bundle\CKFinderBundle\Form\Type\CKFinderFileChooserType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * CKFinderFileChooserType test.
 */
class CKFinderFileChooserTypeTest extends TypeTestCase
{
    protected function getExtensions()
    {
        $fieldType = new CKFinderFileChooserType();

        return array(new PreloadedExtension(array(
            $fieldType->getName() => $fieldType,
        ), array()));
    }

    public function testFileChooserInstantiation()
    {
        $this->factory->create('ckfinder_file_chooser');
    }

    public function testDefaultOptions()
    {
        $form = $this->factory->create('ckfinder_file_chooser');
        $view = $form->createView();

        $this->assertSame('popup', $view->vars['mode']);
        $this->assertSame('Browse', $view->vars['button_text']);
        $this->assertSame(array(), $view->vars['button_attr']);
        $this->assertSame('ckf_filechooser_' . $view->vars['id'], $view->vars['button_id']);
    }

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testModeOptionExpectsModalOrPopup()
    {
        $this->factory->create('ckfinder_file_chooser', null, array(
            'mode' => 'foo'
        ));
    }

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testButtonTextOptionExpectsString()
    {
        $this->factory->create('ckfinder_file_chooser', null, array(
            'button_text' => array()
        ));
    }

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testButtonAttrOptionExpectsArray()
    {
        $this->factory->create('ckfinder_file_chooser', null, array(
            'button_attr' => 'foo'
        ));
    }

    public function testViewValues()
    {
        $form = $this->factory->create('ckfinder_file_chooser', null, array(
            'mode' => 'modal',
            'button_text' => 'foo',
            'button_attr' => array('class' => 'bar')
        ));
        $view = $form->createView();

        $this->assertSame('modal', $view->vars['mode']);
        $this->assertSame('foo', $view->vars['button_text']);
        $this->assertSame(array('class' => 'bar'), $view->vars['button_attr']);
    }
}
