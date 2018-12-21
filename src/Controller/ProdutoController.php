<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProdutoType;
use App\Entity\Produto;

class ProdutoController extends Controller
{
    /**
     * @Route("/produto", name="listar_produto")
     * @Template("produto/index.html.twig")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $produtos=$em->getRepository(Produto::class)->findAll();

        return [
            'produtos' => $produtos,
        ];
    }

    /**
     * @param Request $request
     * 
     * @Route("/produto/cadastrar", name="cadastrar_produto")
     * @Template("produto/create.html.twig")
     * @return Response
     */
    public function create(Request $request)
    {
    $produto = new Produto();

    $form = $this->createForm(ProdutoType::class, $produto);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($produto);
        $em->flush();
        $this->addFlash('success', "Cadastrado com sucesso!");

        return $this->redirectToRoute('listar_produto');
    }
    
    return $this->render("produto/create.html.twig", [
            'form' => $form->createView()
    ]);

    }

    /**
     * @param Request $request
     * @return Response
     * @Template()
     * @Route("produto/editar/{id}", name="editar_produto")
     */
    public function update(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())    {
            $em->persist($produto);
            $em->flush();

            $this->get("session")->getFlashBag()->set("success","O produto foi alterado com sucesso");
            return $this->redirectToRoute('listar_produto');
        }

        return $this->render("produto/update.html.twig", [
            'produto'=>$produto,
            'form'=>$form->createView()
    ]);
    }

    /**
     * @param Request $request
     * @param $id
     * 
     * @Route("produto/apagar/{id}", name="apagar_produto")
     */
    public function delete(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);

        if(!$produto)   {
            $mensagem = "Produto não encontrado";
            $tipo = "warning";
        } else  {
            $em->remove($produto);
            $em->flush();
            $mensagem = "Produto foi excluído com sucesso!";
            $tipo  = "success";

        }

        $this->get('session')->getFLashBag()->set($tipo, $mensagem);
        return $this->redirectToRoute("listar_produto");
    }


    /**
     * @param Request $request
     * @param $id
     * 
     * @Route("produto/visualizar/{id}", name="visualizar_produto")
     * @Template("AppBundle:produto:_form.html.twig")
     * @return Response
     */
    public function view(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository(Produto::class)->find($id);


        return $this->render("produto/view.html.twig",  [
            'produto'=>$produto
        ]);
    }
}
