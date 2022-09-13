<?php

namespace App\Form;

use App\Entity\Reservation;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullname', TextType::class, [
                'required' => true,
            ])
            ->add('date', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'MM/dd/yyyy',

            ])
            ->add('hours', IntegerType::class, [
                'required' => true,
                'attr' => [
                    'min' => 2,
                    'max' => 10,
                ],
            ])
            ->add('participants', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'min' => 1,
                ],
            ])
            ->add('address', TextType::class, [
                'required' => false,
            ])
            ->add('theme', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Black & white, Halloween ...',
                ],
            ])
            ->add('phone', TextType::class, [
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'required' => true,
            ])
            ->add('reach', ChoiceType::class, [
                'choices' => [
                    'Par email' => 'Email',
                    'Par téléphone' => 'Téléphone',
                    'Par message' => 'SMS',
                ],
                'required' => true,
            ])
            ->add('moyen', ChoiceType::class, [
                'choices' => [
                    'Notre site internet' => 'website',
                    'Blog' => 'blog',
                    'Instagram' => 'instagram',
                    'Tiktok' => 'tiktok',
                    'Journaux' => 'journaux',
                    'Facebook' => 'facebook',
                    'SnapChat' => 'snapchat',
                    'Bouche à oreille' => 'Bouche à oreille',

                ],
                'required' => true,
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Anniversaire' => 'anniversaire',
                    'Mariage' => 'mariage',
                    'Fiançailles' => 'Fiancailles',
                    'EVJF' => 'EVJF',
                    'Corporate (Entreprise)' => 'corporate',
                    'Baptême' => 'bapteme',
                    'Bal de promo' => 'bal de promo',
                    'Autres' => 'autres',
                ],
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'app_home',
                'locale' => 'fr',
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
