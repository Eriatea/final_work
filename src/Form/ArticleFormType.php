<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Заголовок статьи',
                'attr' => [
                    'placeholder' => 'Заголовок статьи',
                    'value' => 'Тестовая статья'
                ],
                'required' => false,
            ])
            ->add('theme', ChoiceType::class, [
                'label' => 'Тематика',
                'choices' => [
                    '-' => '-',
                    'Про еду' => 'Про еду',
                    'Про PHP' => 'Про PHP'
                ]
            ])
            ->add('keywords', TextType::class, [
                'label' => 'Ключевое слово',
                'attr' => [
                    'placeholder' => 'Ключевое слово',
                    'value' => 'EXAMPLE',
                    'disabled' => true
                ]
            ])
            ->add('genitive', TextType::class, [
                'mapped' => false,
                'label' => 'Родительный падеж',
                'attr' => [
                    'placeholder' => 'Родительный падеж',
                    'value' => 'EXAMPLE',
                    'disabled' => true
                ]
            ])
            ->add('plural', TextType::class, [
                'mapped' => false,
                'label' => 'Множественное число',
                'attr' => [
                    'placeholder' => 'Множественное число',
                    'value' => 'EXAMPLES',
                    'disabled' => true
                ]
            ])
            ->add('sizeFrom', IntegerType::class, [
                'mapped' => false,
                'label' => 'Размер статьи от',
                'attr' => [
                    'placeholder' => 'Размер статьи от'
                ]
            ])
            ->add('sizeTo', IntegerType::class, [
                'mapped' => false,
                'label' => 'До',
                'attr' => [
                    'placeholder' => 'До'
                ]
            ])
            ->add('words', TextType::class, [
                'mapped' => false,
                'label' => 'Продвигаемые слова',
                'attr' => [
                    'placeholder' => 'Ключевое слово',
                    'value' => 'EXAMPLE',
                ]
            ])
            ->add('image_filename', FileType::class, [
                'mapped' => false,
                'label' => 'Изображения',
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
