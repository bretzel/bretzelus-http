<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-09
 * Time: 07:01
 */

namespace App;



class Element
{
    private $_Out;
    private $_Id;
    private $_Parent;
    private $_Tag;
    private $_Children = [];
    private $_Classes = []; // Forme sérialisée : class=" cls1 cls23 ..."
    /**
     * @var array Contient la tableau associatif des element de style, associés avec l'attribut 'Style' Ex.: Style=" backgroud-color: #000".
     *  Donc "background-color est la clef et #000 est sa valeur associée. : $_CssProperties['background-color'] = '#000';
     */
    private $_CssProperties = [];

    /**
     * @var array Tableau associatif des attributs.
     */
    private $_AttrElements = []; // id=; class; Style; etc...
    /**
     * @var string contient le texte finale du style [Sérialisation du tableau associatif _CssProperties]
     */
    private $_Style;

    /**
     * @var string Ligne de texte des attributs sérialisés.
     */
    private $_Attributes;

    /**
     * Element constructor.
     * @param Element $aParent Élément parent. Peut etre null
     * @param string $aId Identificateur DOM Unique. Peut etre null
     */
    public function __construct(?Element $aParent = null, ?string $aId = null, ?string $aTag = 'div')
    {
        if(isset($aId)) {
            $this->_Id = $aId;
            $this->_AttrElements['id'] = $aId;
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
     * @param Element $aElement Rajoute dans la liste des enfants, l'instance d'un élément.
     */
    public function Pushback(Element $aElement)
    {
        $this->_Children[] = $aElement;
    }

    /**
     * Recherche l'instance d'un élément enfant dans la liste des enfants.
     * @param string $aId
     * @return Element|null  Renvoie l'instance de l'enfant ou null si non trouvé.
     */
    public function QueryChild(string $aId) : ?Element
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
     * @note : Si cet élément n'a pas d'éléments enfants, il faut trouver comment
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
        $this->_AttrElements['Style'] = $this->_Style;
        //$this->_Style = "";
    }

    /**
     * <tag [Element::SerializeAttributes()] >
     */
    public function SerializeAttributes()
    {
        $this->_Attributes = "";
        foreach ($this->_AttrElements as $Attr => $Value)
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
};

?>