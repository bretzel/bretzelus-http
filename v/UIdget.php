<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-17
 * Time: 13:21
 */

namespace Ui;


class UIdget
{
    private $_Out;
    private $_Id;
    private $_Parent;
    private $_Tag;
    private $_Children = [];
    private $_Classes = []; // Forme sérialisée : class=" cls1 cls23 ..."
    /**
     * @var array Contient la tableau associatif des UIdget de style, associés avec l'attribut 'Style' Ex.: Style=" backgroud-color: #000".
     *  Donc "background-color est la clef et #000 est sa valeur associée. : $_CssProperties['background-color'] = '#000';
     */
    private $_CssProperties = [];

    /**
     * @var array Tableau associatif des attributs.
     */
    private $_AttrUIdgets = []; // id=; class; Style; etc...
    /**
     * @var string contient le texte finale du style [Sérialisation du tableau associatif _CssProperties]
     */
    private $_Style;

    /**
     * @var string Ligne de texte des attributs sérialisés.
     */
    private $_Attributes;

    /**
     * UIdget constructor.
     * @param UIdget $aParent Élément parent. Peut etre null
     * @param string $aId Identificateur DOM Unique. Peut etre null
     */
    public function __construct(?UIdget $aParent = null, ?string $aId = null, ?string $aTag = 'div')
    {
        if(isset($aId)) {
            $this->_Id = $aId;
            $this->_AttrUIdgets['id'] = $aId;
        }

        if(isset($aParent)) {
            $this->_Parent = $aParent;
            $this->_Parent->Pushback($this);
        }

        $this->_Tag = $aTag;
    }

    /**
     * @return string Renvoie l'identificateur DOM de cet élément.
     */
    public function ID() : string { return $this->_Id; }

    /**
     * @param UIdget $aUIdget Rajoute dans la liste des enfants, l'instance d'un élément.
     */
    public function Pushback(UIdget $aUIdget)
    {
        $this->_Children[] = $aUIdget;
    }

    /**
     * @return rien
     */
    public function cssClass(?string $aClass = null)
    {
        if(isset($aClass))
            $this->_Classes[] = aClass;

    }


    /**
     * Recherche l'instance d'un élément enfant dans la liste des enfants.
     * @param string $aId
     * @return UIdget|null  Renvoie l'instance de l'enfant ou null si non trouvé.
     */
    public function QueryChild(string $aId) : ?UIdget
    {

        foreach($this->_Children as $child) {
            if($child->ID() === $aId)
                return $child;
            else {
                $Q = $child->QueryChild($aId);
                if ( $Q !== null )
                    return $Q;
            }
        }
        return null;
    }



    /**
     * @return string Renvoie le tag de fermeture de l'élément.
     * @note : Si ce Uidget n'a pas d'éléments enfants, il faut trouver comment
     * le tag html devrait nécéssiter un tag de fermeture...
     * Pour l'instant, cette tâche est laissée aux classes dérivées.
     */
    public function Close(): string { return "</$this->_Tag>"; }

    /**
     * Construit le text des propriétés css sérialisées.
     * @return rien
     */
    protected function SerializeStyle()
    {
        $this->_Style = "";
        foreach($this->_CssProperties as $property => $Value)
            $this->_Style .= $property.': '.$Value.'; ';
        $this->_AttrUIdgets['Style'] = $this->_Style;
        //$this->_Style = "";
    }

    /**
     * <tag [UIdget::SerializeAttributes()] >
     */
    public function SerializeAttributes()
    {
        $this->_Attributes = "";
        foreach ($this->_AttrUIdgets as $Attr => $Value)
            $this->_Attributes .= $Attr.'=\"'.$Value.'"';
    }

    /**
     * @return string Le texte code HTML de cet élémernt sérialisé..
     */
    public function Serialize() : string {

        $this->_Out = "<$this->_Tag ";
        //...

        return $this->_Out;
    }

}