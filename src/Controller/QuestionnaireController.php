<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Entity\Field;
use App\Entity\Questionnaire;
use App\Entity\Reponses;
use App\Entity\Reponse;

class QuestionnaireController extends AbstractController
{
    /**
     * @Route("/questionnaire/{id}", name="questionnaire")
     */
    public function index($id = null)
    {
        if(isset($id))
        {
            $json = file_get_contents('http://54.36.74.97/questionnaire/' . $id);

            if($json !== false)
            {
                $content = json_decode($json, true); 
                
                $infoQuestionnaire = extract($content['Questionnaire']);//crée la variable $Question $Nom $Presentation     

                $questionnaire = new Questionnaire();

                $questionnaire->setOk($content['ok'])
                              ->setCle($id)
                              ->setType($content['Type'])
                              ->setRealise($content['Realise'])
                              ->setNom($Nom)
                              ->setPresentation($Presentation)
                              ->setNomDestinataire($content['Nom'])
                              ->setPrenomDestinataire($content['Prenom'])
                              ->setSociete($content['NomSociete']);;

                $i = 0;
                $tabQuestion = array();
                foreach ($Question as $key => $value)
                {
                    $field = new Field();

                    $field->setId($value['Id'])
                          ->setLibelle($value['Libelle'])
                          ->setTypeQuestion($value['TypeQuestion'])
                          ->setAide($value['Aide'])
                          ->setObligatoire($value['Obligatoire'])
                          ->setBorneInf(intval($value['BorneInf']))
                          ->setBorneSup(intval($value['BorneSup']));
                          
                    if(isset($value['Choix']))
                    {
                        $field->setChoix($value['Choix']);
                    }
                    
                    $tabQuestion[$i] = $field;                   

                    $i++;
                }

                $questionnaire->setField($tabQuestion);                            

                if($questionnaire->getRealise() == false)
                {
                    return $this->render('questionnaire/index.html.twig', [                        
                        'questionnaire' => $questionnaire
                    ]);
                }
                else
                {
                    throw new Exception('Le questionnaire a déjà été envoyé.');
                }

            }
            else
            {
                throw new Exception('Récupération du questionnaire impossible.');
            }
        }
        else
        {
            throw new Exception('Identifiant inconnu.');
        }        
    }

    /**
     * @Route("/submitQuestionnaire/{id}", name="submitQuestionnaire")
     */
    public function submitQuestionnaire($id = null, Request $request)
    {
        if($id !== null)
        {
            $idQuestionnaire = $id;

            $request = Request::createFromGlobals();
            
            $i = 0;
            $tabReponses = array();
            foreach ($request->request->all() as $key => $value) 
            {
                $elt = explode("|",$key);
                
                if($elt[0] == 'id')
                {
                    if (!empty($value))
                    {
                        if ($elt[2] == "vrai" && $value[0] != "")
                        {                    
                            $j =  0;
                            $tabReponse = array();
                            foreach ($value as $keyQuestion => $valueQuestion) 
                            {
                                $reponse = new Reponse();
                                $reponse->setReponse($valueQuestion);
                                $tabReponse[$j] = $reponse;
                                $j++;    
                            }
                            
                            $reponses = new Reponses();
                            $reponses->setId(intval($elt[1]))
                                    ->setReponses($tabReponse);

                            $tabReponses[$i] = $reponses;
                            
                            $i++;
                        }
                        else
                        {
                            throw new Exception('Vous devez répondre à toutes les questions obligatoires.');
                        }
                    }
                }            
            }
            
            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];

            $serializer = new Serializer($normalizers, $encoders);

            $json = '{"Reponse":' . $serializer->serialize($tabReponses, 'json') . '}';
            
            // dump($json);
            //     die();

            $options = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/json",
                    'ignore_errors' => true,
                    'content' => $json
                )
            );
            
            $context = stream_context_create($options);
            
            $result = file_get_contents('http://54.36.74.97/questionnaire/' . $id, false, $context);
            
            $reponseJson = json_decode($result, true);
            
            if($reponseJson['ok'] !== false)
            {
                $reponseSubmit = "Le questionnaire a bien été envoyé.";
            }
            else
            {
                $reponseSubmit = $reponseJson['Erreur'];
            }

            return $this->render('questionnaire/submitQuestionnaire.html.twig', [
                'reponse' => $reponseSubmit
            ]);
        }
        else
        {
            throw new Exception('Identifiant inconnu.');
        }
    }
}
