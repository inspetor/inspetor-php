<?php
/**
 * Address
 *
 * PHP version 5
 *
 * @category Class
 * @package  Inspetor\Model
 * @author   Inspetor Team
 * @link     ""
 */

/**
 * Inspetor Antifraud
 *
 * This is an antifraud product developed to analyzes transactions and identify frauds using trackers and analytics tools. This file must explain every request and parametes that a library must provide to a client.
 *
 * Contact: theo@useinspetor.com
 */

namespace Inspetor\Model;

use Inspetor\Model\Address;
use Inspetor\Model\Category;

class Event implements JsonSerializable {

	const CREATE_ACTION = "event_create";
	const UPDATE_ACTION = "event_update";
	const DELETE_ACTION = "event_delete";

    const STATUS_DRAFT = "draft";
    const STATUS_PRIVATE = "private";
	const STATUS_PUBLISHED = "published";
	const STATUS_OTHER = "other";

    /**
     * PROPERTIES
     */

	/**
	 * @param string
	 */
	private $id;

	/**
	 * @param string
	 */
	private $name;

	/**
	 * @param string
	 */
	private $description;

	/**
	 * @param string
	 */
	private $creation_timestamp;

	/**
	 * @param string
	 */
	private $update_timestamp;

	/**
	 * @param array
	 */
	private $sessions;

	/**
	 * @param string
	 */
	private $status;

	/**
	 * @param string
	 */
	private $status_other;

	/**
	 * @param array
	 */
	private $seating_options;

	/**
	 * @param array
	 */
	private $categories;

	/**
	 * @param Inspetor\Model\Address $address
	 */
	private $address;

	/**
	 * @param string
	 */
	private $url;

	/**
	 * @param $producer_id
	 */
	private $producer_id;

	/**
	 * @param array
	 */
	private $admins_id;


    /**
     * ISVALID
     */

	/**
     * Validate Event instance
     *
     * @return void
     */
    public function isValid() {
        if (!$this->id) {
            throw new Exception("Id can't be null");
        }

		if (!$this->creation_timestamp) {
            throw new Exception("Creation timestamp can't be null");
		}

		if (!$this->name) {
            throw new Exception("Name can't be null");
        }

        if (!$this->update_timestamp) {
            throw new Exception("Update timestamp can't be null");
		}

        if (!$this->producer_id) {
            throw new Exception("Producer id can't be null");
		}

		if (!$this->address) {
            throw new Exception("Address can't be null");
		}

		if (!$this->sessions || empty($this->sessions)) {
            throw new Exception("Sessions can't be null neither an empty array");
		}

		if (!$this->seating_options || empty($this->seating_options)) {
            throw new Exception("Sessions can't be null neither an empty array");
		}
        if (!$this->categories || empty($this->categories)) {
            throw new Exception("Categories can't be null");
        }

		if (!$this->status) {
			$this->validateStatus();
		}

    }

	/**
	 * Validate status and set "other" if null
	 *
	 * @return void
	 */
    private function validateStatus() {
        $all_status = [
            self::STATUS_DRAFT,
            self::STATUS_PRIVATE,
            self::STATUS_PUBLISHED,
        ];

        if (!in_array($this->status, $all_status)) {
            $this->setOtherStatus(base64_encode($this->status));
            $this->setStatus(self::STATUS_OTHER);
        }
    }

    /**
     * GETTERS AND SETTERS
     */


	/**
	 * Get the value of id
     *
     * @param boolean $debug
     *
	 * @return string
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
	 * @param string  $id
     * @param boolean $is_editable
     *
	 * @return self
	 */
	public function setId($id, $is_editable = false) {
        if ($is_editable) {
            $this->id = base64_encode($id);
        } else {
            $this->id = $id;
        }
		return $this;
	}

	/**
	 * Get the value of name
     *
     * @param boolean $debug
     *
	 * @return string
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
	 * @param string  $name
     * @param boolean $is_editable
	 *
	 * @return self
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
	 * Get the value of description
     *
     * @param boolean $debug
     *
	 * @return string
	 */
	public function getDescription($debug = false) {
        if ($debug) {
            return base64_decode($this->description);
        }
		return $this->description;
    }

	/**
	 * Set the value of description
	 *
	 * @param string  $description
     * @param boolean $is_editable
	 *
	 * @return self
	 */
	public function setDescription($description, $is_editable = true) {
        if ($is_editable) {
            $this->description = base64_encode($description);
        } else {
            $this->description = $description;
        }
		return $this;
	}

    /**
     * Get the value of update_timestamp
     *
     * @return string
     */
    public function getUpdateTimestamp() {
        return $this->update_timestamp;
    }

    /**
     * Set the value of update_timestamp
     *
     * @param string $update_timestamp
     *
     * @return self
     */
    public function setUpdateTimestamp($update_timestamp) {
        $this->update_timestamp = $update_timestamp;
        return $this;
    }

    /**
     * Get the value of creation_timestamp
     *
     * @return string
     */
    public function getCreationTimestamp() {
        return $this->creation_timestamp;
    }

    /**
     * Set the value of creation_timestamp
     *
     * @param string $update_timestamp
     *
     * @return self
     */
    public function setCreationTimestamp($creation_timestamp) {
        $this->create_function = $creation_timestamp;
        return $this;
    }

	/**
	 * Get the value of sessions
	 *
	 * @return array
	 */
	public function getSessions() {
		return $this->sessions;
    }

	/**
	 * Set the value of sessions
	 *
	 * @param array $sessions
	 *
	 * @return self
	 */
	public function setSessions($sessions) {
        $this->sessions = $sessions;
		return $this;
	}

	/**
	 * Get the value of status
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
    }

	/**
	 * Set the value of status
	 *
	 * @param string $status
	 *
	 * @return self
	 */
	public function setStatus($status) {
        $this->status = $status;
		return $this;
	}

	/**
	 * Get the value of other status
	 *
	 * @return string
	 */
	public function getOtherStatus() {
		return $this->status;
    }

	/**
	 * Set the value of other status
	 *
	 * @param string $status
	 *
	 * @return self
	 */
	public function setOtherStatus($status_other) {
        $this->status_other = $status_other;
		return $this;
	}

	/**
	 * Get the value of categories
	 *
	 * @return array
	 */
	public function getCategories() {
		return $this->categories;
    }

	/**
	 * Set the value of categories
	 *
	 * @param array $categories
	 *
	 * @return self
	 */
	public function setCategories($categories) {
        $this->categories = $categories;
		return $this;
	}

	/**
	 * Get the value of address
	 *
     * @return Inspetor\Model\Address
	 *
	 */
	public function getAddress() {
		return $this->address;
    }

	/**
	 * Set the value of address
	 *
	 * @param Inspetor\Model\Address $address
	 *
	 * @return self
	 */
	public function setAddress($address) {
        $this->address = $address;
		return $this;
	}

	/**
	 * Get the value of url
	 *
	 * @param boolean $debug
	 *
	 * @return string
	 */
	public function getUrl($debug = false) {
        if ($debug) {
            return base64_decode($this->url);
        }
		return $this->url;
    }

	/**
	 * Set the value of url
	 *
     * @param string  $url
     * @param boolean $is_editable
	 *
	 * @return self
	 */
	public function setUrl($url, $is_editable = true) {
        if ($is_editable) {
            $this->url = base64_encode($url);
        } else {
            $this->url = $url;
        }
		return $this;
	}

	/**
	 * Get the value of producer_id
	 *
	 * @param boolean $debug
	 *
	 * @return string
	 */
	public function getProducerId($debug = false) {
        if ($debug) {
            return base64_decode($this->producer_id);
        }
		return $this->producer_id;
    }

	/**
	 * Set the value of producer_id
	 *
	 * @param string  $producer_id
     * @param boolean $is_editable
	 *
	 * @return self
	 */
	public function setProducerId($producer_id, $is_editable = false) {
        if ($is_editable) {
            $this->producer_id = base64_encode($producer_id);
        } else {
            $this->producer_id = $producer_id;
        }
		return $this;
	}

	/**
	 * Get the value of admins_id
	 *
	 * @param boolean $debug
	 *
	 * @return array
	 */
	public function getAdminsId($debug = false) {
		if ($debug) {
			$admins = array();
            foreach ($this->admins_id as $admin) {
				$admin = base64_decode($admin);
				array_push($admins, $admin);
			}
			return $admins;
        }
		return $this->admins_id;
    }

	/**
	 * Set the value of admins_id
	 *
	 * @param array $admins_id
	 *
	 * @return self
	 */
	public function setAdminsId($admins_id, $is_editable = false) {
        if ($is_editable) {
            $this->admins_id = base64_encode($admins_id);
        } else {
            $this->admins_id = $admins_id;
        }
		return $this;
	}

	/**
	 * Get the value of seating_options
	 *
	 * @param boolean $debug  If set as true will decode the value
	 *
	 * @return array
	 */
	public function getSeatingOptions($debug = false) {
        if ($debug) {
            return base64_decode($this->seating_options);
        }
		return $this->seating_options;
    }

	/**
	 * Set the value of seating_options
	 *
	 * @param array   $seating_options
	 * @param boolean $is_editable  If set as true will encode the value
	 *
	 * @return self
	 */
	public function setSeatingOptions($seating_options, $is_editable = true) {
        if ($is_editable) {
            $this->seating_options = base64_encode($seating_options);
        } else {
            $this->seating_options = $seating_options;
        }
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
            "event_id"                 => $this->getId(),
            "event_name"               => $this->getName(),
            "event_description"        => $this->getDescription(),
            "event_creation_timestamp" => $this->getCreationTimestamp(),
            "event_update_timestamp"   => $this->getUpdateTimestamp(),
            "event_sessions"           => $this->getSessions()->jsonSerialize(),
            "event_status"             => $this->getStatus(),
			"event_status_other"       => $this->getOtherStatus(),
			"event_seating_options"    => $this->getSeatingOptions(),
            "event_categories"         => $this->getCategories()->jsonSerialize(),
            "event_address"            => $this->getAddress()->jsonSerialize(),
            "event_url"                => $this->getUrl(),
            "event_producer_id"        => $this->getProducerId(),
            "event_admins_id"          => $this->getAdminsId()
        ];

        return $array;
    }
}

?>