<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use AppBundle\Entity\Atividade;

class AtividadeController extends Controller
{
    public function indexAction($filtro = null)
    {
        if (!$filtro) {
            $repository = $this->getDoctrine()->getRepository('AppBundle:Atividade');
            $atividades = $repository->findAll();
        } else {
            switch ($filtro) {
                case 'ativo':
                    $pesquisa = 'Ativo';
                    $repository = $this->getDoctrine()->getRepository('AppBundle:Atividade');

                    $query = $repository->createQueryBuilder('p')
                        ->where('p.situacao = :situacao')
                        ->setParameter('situacao', $pesquisa)
                        ->orderBy('p.id', 'ASC')
                        ->getQuery();

                    $atividades = $query->getResult();
                    break;

                case 'inativo':
                    $pesquisa = 'Inativo';
                    $repository = $this->getDoctrine()->getRepository('AppBundle:Atividade');

                    $query = $repository->createQueryBuilder('p')
                        ->where('p.situacao = :situacao')
                        ->setParameter('situacao', $pesquisa)
                        ->orderBy('p.id', 'ASC')
                        ->getQuery();

                    $atividades = $query->getResult();
                    break;

                case 'pendente':
                    $pesquisa = 1;

                    $query = $this->getDoctrine()->getEntityManager()
                        ->createQuery(
                            'SELECT a FROM AppBundle:Atividade a
                            JOIN a.status s
                            WHERE s.id = :id'
                        )->setParameter('id', $pesquisa);

                    $atividades = $query->getResult();
                    break;

                case 'desenvolvimento':
                    $pesquisa = 2;

                    $query = $this->getDoctrine()->getEntityManager()
                        ->createQuery(
                            'SELECT a FROM AppBundle:Atividade a
                            JOIN a.status s
                            WHERE s.id = :id'
                        )->setParameter('id', $pesquisa);

                    $atividades = $query->getResult();
                    break;

                case 'teste':
                    $pesquisa = 3;

                    $query = $this->getDoctrine()->getEntityManager()
                        ->createQuery(
                            'SELECT a FROM AppBundle:Atividade a
                            JOIN a.status s
                            WHERE s.id = :id'
                        )->setParameter('id', $pesquisa);

                    $atividades = $query->getResult();
                    break;

                case 'concluido':
                    $pesquisa = 4;

                    $query = $this->getDoctrine()->getEntityManager()
                        ->createQuery(
                            'SELECT a FROM AppBundle:Atividade a
                            JOIN a.status s
                            WHERE s.id = :id'
                        )->setParameter('id', $pesquisa);

                    $atividades = $query->getResult();
                    break;
            }
        }

        return $this->render('AppBundle:Atividade:index.html.twig', array(
            'atividades' => $atividades,
        ));
    }

    public function atualizarAction($id, Request $request)
    {
        $atividade = $this->getDoctrine()->getRepository('AppBundle:Atividade')->findOneById($id);

        if (!$atividade) {
            $this->addFlash(
                'danger',
                "Falha na atualizacao! Não existe Atividade com o ID fornecido: $id"
            );

            return $this->redirectToRoute('atividades');
        }

        $form = $this->createFormBuilder($atividade)
            ->add('name', TextType::class)
            ->add('descricao', TextareaType::class)
            ->add('situacao', ChoiceType::class, array(
                    'choices'  => [
                        'Ativo' => 'Ativo',
                        'Inativo' => 'Inativo',
                    ],
                    // *this line is important*
                    'choices_as_values' => true,
            ))
            ->add('status', EntityType::class, array(
                    // query choices from this entity
                    'class' => 'AppBundle:Status',
                    'choice_label' => 'name',
            ))
            ->add('data_inicio', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
            ))
            ->add('data_fim', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'required' => false,
            ))
            ->add('save', SubmitType::class, array('label' => 'Atualizar'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $atividade = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($atividade);
            $em->flush();

            $this->addFlash(
                'notice',
                "Atualizacao da atividade id $id efetuada com sucesso!"
            );

            return $this->redirectToRoute('atividades');
        }

        return $this->render('AppBundle:Atividade:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function criarAction(Request $request)
    {
        $atividade = new Atividade();

        $form = $this->createFormBuilder($atividade)
            ->add('name', TextType::class)
            ->add('descricao', TextareaType::class)
            ->add('situacao', ChoiceType::class, array(
                    'choices'  => [
                        'Ativo' => 'Ativo',
                        'Inativo' => 'Inativo',
                    ],
                    // *this line is important*
                    'choices_as_values' => true,
            ))
            ->add('status', EntityType::class, array(
                    // query choices from this entity
                    'class' => 'AppBundle:Status',
                    'choice_label' => 'name',
            ))
            ->add('data_inicio', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
            ))
            ->add('data_fim', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'required' => false,
            ))
            ->add('save', SubmitType::class, array('label' => 'Criar'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $atividade = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($atividade);
            $em->flush();

            $this->addFlash(
                'notice',
                "Atividade id {$atividade->getId()} criado com sucesso!"
            );

            return $this->redirectToRoute('atividades');
        }

        return $this->render('AppBundle:Atividade:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function excluirAction($id)
    {
        $atividade = $this->getDoctrine()->getRepository('AppBundle:Atividade')->findOneById($id);

        if (!$atividade) {
            $this->addFlash(
                'notice',
                "Falha na exclusão! Não existe Atividade com o ID fornecido: $id"
            );
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->remove($atividade);
            $em->flush();

            $this->addFlash(
                'notice',
                'Exclusao efetuada com sucesso!'
            );
        }

        return $this->redirectToRoute('atividades');
    }
}
