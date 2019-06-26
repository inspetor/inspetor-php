<?php
/**
 * Category
 *
 * PHP version 5
 *
 * @category Class
 * @package  Inspetor\Model
 * @author   Inspetor Team
 */

/**
 * Inspetor Antifraud
 *
 * This is an antifraud product developed to analyzes transactions and identify frauds using trackers and analytics tools. This file must explain every request and parametes that a library must provide to a client.
 */

namespace Inspetor\Model;

class Category implements JsonSerializable {

    /**
     * PROPERTIES
     */
    var $id;
    var $name;
    var $slug;
    var $is_public;

    public function isValid() {
        if ($this->id == null || $this->id == "") {
            throw new Exception("Id can't be null");
        }

        if ($this->name == null || $this->name == "") {
            throw new Exception("Name can't be null");
        }

        if ($this->slug == null || $this->slug == "") {
            throw new Exception("Slung can't be null");
        }

        if ($this->is_public == null || $this->is_public == "") {
            throw new Exception("Is_public can't be null");
        }
    }

    /**
     * SETTERS AND GETTERS
     */

    /**
     * Get the value of Id
     */ 
    public function getId($debug = false) {
        if ($debug) {
            return base64_decode($this->id);
        }
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id, $is_editable = true) {
        if ($is_editable) {
            $this->id = base64_encode($id);
        } else {
            $this->id = $id;
        }
        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName($debug = false) {
        if ($debug) {
            return base64_decode($this->name);
        }
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name, $is_editable = true) {
        if ($is_editable) {
            $this->name = base64_encode($name);
        } else {
            $this->name = $name;
        }
        return $this;
    }

    /**
     * Get the value of slug
     */ 
    public function getSlug($debug = false) {
        if ($debug) {
            return base64_decode($this->slug);
        }
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug, $is_editable = true) {
        if ($is_editable) {
            $this->slug = base64_encode($slug);
        } else {
            $this->slug = $slug;
        }
        return $this;
    }

    /**
     * Get the value of is_public
     */ 
    public function getIsPublic() {
        return $this->is_public;
    }

    /**
     * Set the value of is_public
     *
     * @return  self
     */ 
    public function setIsPublic($is_public) {
        $this->is_public = $is_public;
        return $this;
    }

    /**
     * JSONSERIALIZE
    */

    /**
     * Create a json with the data from the object
     * @return array
    */
    public function jsonSerialize() {
        $array = [
            "category_id" => $this->getId(),
            "category_name"=> $this->getName(),
            "category_slug" => $this->getSlug(),
            'category_is_public' => $this->getIsPublic()
        ];

        return $array;
    }

}


?>