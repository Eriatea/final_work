<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                    'value' => 'Тестовая статья',
                    'disabled' => true
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
            ]);
//            ->add('genitive', TextType::class, [
//                'label' => 'Родительный падеж',
//                'attr' => [
//                    'placeholder' => 'Родительный падеж',
//                    'value' => 'EXAMPLE',
//                    'disabled' => true
//                ]
//            ])
//            ->add('plural', TextType::class, [
//                'label' => 'Множественное число',
//                'attr' => [
//                    'placeholder' => 'Множественное число',
//                    'value' => 'EXAMPLES',
//                    'disabled' => true
//                ]
//            ])
//            ->add('sizeFrom', IntegerType::class, [
//                'label' => 'Размер статьи от',
//                'attr' => [
//                    'placeholder' => 'Размер статьи от'
//                ]
//            ])
//            ->add('sizeTo', IntegerType::class, [
//                'label' => 'До',
//                'attr' => [
//                    'placeholder' => 'До'
//                ]
//            ])
//            ->add('words', CollectionType::class, [
//                'label' => 'Продвигаемые слова',
//                'entry_type' => TextType::class,
//                'allow_add' => true,
//                'allow_delete' => true
//            ])
//            ->add('image_filename', FileType::class, [
//                'label' => 'Изображения',
//            ]);
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
