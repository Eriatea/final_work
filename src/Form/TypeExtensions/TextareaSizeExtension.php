<?php

namespace App\Form\TypeExtensions;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextareaSizeExtension extends AbstractTypeExtension
{
    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        return [TextareaType::class];
    }

    /**
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     * @return void
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['attr']['rows'] = $options['rows'];
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'rows' => 10
        ]);
    }
}