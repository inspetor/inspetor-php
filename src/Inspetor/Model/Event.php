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

use Inspetor\Exception\ModelException\EventException;
use Inspetor\Model\Address;
use Inspetor\Model\AbstractModel;
use JsonSerializable;

class Event extends AbstractModel implements JsonSerializable {

	const EVENT_CREATE_ACTION = "event_create";
	const EVENT_UPDATE_ACTION = "event_update";
	const EVENT_DELETE_ACTION = "event_delete";

    const DRAFT_STATUS     = "draft";
    const PRIVATE_STATUS   = "private";
	const PUBLISHED_STATUS = "published";
	const OTHER_STATUS     = "other";

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
     * @param integer
	 */
	private $timestamp;

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
            throw new EventException(7001);
        }

		if (!$this->name) {
            throw new EventException(7002);
        }

        if (!$this->timestamp) {
            throw new EventException(7003);
		}

        if (!$this->producer_id) {
            throw new EventException(7004);
		}

		if (!$this->admins_id || empty($this->admins_id)) {
            throw new EventException(7012);
		}

		if (!$this->address) {
            throw new EventException(7005);
		}

		if (!$this->sessions || empty($this->sessions)) {
            throw new EventException(7006);
		}

		if (!$this->status) {
			throw new EventException(7009);
		}

		$this->validateStatus();
    }

	/**
	 * Validate status and set "other" if null
	 *
	 * @return void
	 */
    private function validateStatus() {
        $all_status = [
            self::DRAFT_STATUS,
            self::PRIVATE_STATUS,
            self::PUBLISHED_STATUS,
        ];

        if (!in_array($this->status, $all_status)) {
            $this->setOtherStatus($this->status);
            $this->setStatus(self::OTHER_STATUS);
        }
    }

    /**
     * GETTERS AND SETTERS
     */


	/**
	 * Get the value of id
     *
     *
	 * @return string
	 */
	public function getId() {
		return $this->id;
    }

	/**
	 * Set the value of id
     *
	 * @param string  $id
     *
	 * @return self
	 */
	public function setId($id) {
        $this->id = $id;
		return $this;
	}

	/**
	 * Get the value of name
     *
     *
	 * @return string
	 */
	public function getName() {
		return $this->name;
    }

	/**
	 * Set the value of name
	 *
	 * @param string  $name
	 *
	 * @return self
	 */
	public function setName($name) {
        $this->name = $name;
		return $this;
	}

	/**
	 * Get the value of description
     *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
    }

	/**
	 * Set the value of description
	 *
	 * @param string  $description
	 *
	 * @return self
	 */
	public function setDescription($description) {
        $this->description = $description;
		return $this;
	}

    /**
     * Get the value of timestamp
     *
     * @return integer
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     *
     * @param integer $timestamp
     *
     * @return self
     */
    public function setTimestamp($timestamp) {
        $this->timestamp = $this->inspetorDateFormatter(
			$timestamp
		);
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
		if ($sessions) {
			foreach($sessions as $session) {
				if (!is_array($session)) {
					throw new EventException(7010);
				}
				if (!array_key_exists("id", $session)
				|| !array_key_exists("timestamp", $session)){
					throw new EventException(7011);
				}
			}
		}
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
		if ($categories) {
			if(!is_array($categories)) {
				throw new EventException(7008);
			}
			foreach($categories as $category) {
				if(!$category) {
					throw new EventException(7008);
				}
			}
		}
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
		if ($address) {
			$address->isValid();
		}
		$this->address = $address;
		return $this;
	}

	/**
	 * Get the value of url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
    }

	/**
	 * Set the value of url
	 *
     * @param string  $url
     *
	 *
	 * @return self
	 */
	public function setUrl($url) {
        $this->url = $url;
		return $this;
	}

	/**
	 * Get the value of producer_id
	 *
	 *
	 *
	 * @return string
	 */
	public function getProducerId() {
		return $this->producer_id;
    }

	/**
	 * Set the value of producer_id
	 *
	 * @param string  $producer_id
     *
	 *
	 * @return self
	 */
	public function setProducerId($producer_id) {
        $this->producer_id = $producer_id;
		return $this;
	}

	/**
	 * Get the value of admins_id
	 *
	 *
	 *
	 * @return array
	 */
	public function getAdminsId() {
		return $this->admins_id;
    }

	/**
	 * Set the value of admins_id
	 *
	 * @param array $admins_id
	 *
	 * @return self
	 */
	public function setAdminsId($admins_id) {
		if ($admins_id) {
			if(!is_array($admins_id)) {
				throw new EventException(7012);
			}
			foreach($admins_id as $admin) {
				if(!$admin) {
					throw new EventException(7012);
				}
			}
		}
        $this->admins_id = $admins_id;
		return $this;
	}

	/**
	 * Get the value of seating_options
	 *
	 *
	 * @return array
	 */
	public function getSeatingOptions() {
		return $this->seating_options;
    }

	/**
	 * Set the value of seating_options
	 *
	 * @param array   $seating_options
	 *
	 * @return self
	 */
	public function setSeatingOptions($seating_options) {
		if ($seating_options) {
			if (!is_array($seating_options)) {
				throw new EventException(7007);
			}
			foreach($seating_options as $seating_option) {
				if(!$seating_option) {
					throw new EventException(7007);
				}
			}
		}
		$this->seating_options = $seating_options;
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
            "event_id"                 => $this->encodeData($this->getId()),
            "event_name"               => $this->encodeData($this->getName()),
            "event_description"        => $this->encodeData($this->getDescription()),
            "event_timestamp"  		   => $this->encodeData($this->getTimestamp()),
            "event_sessions"           => $this->encodeSessions(),
            "event_status"             => $this->encodeData($this->getStatus()),
			"event_status_other"       => $this->encodeData($this->getOtherStatus()),
			"event_seating_options"    => $this->encodeArray($this->getSeatingOptions(), false),
            "event_categories"         => $this->encodeArray($this->getCategories(), false),
            "event_address"            => $this->encodeObject($this->getAddress()),
            "event_url"                => $this->encodeData($this->getUrl()),
            "event_producer_id"        => $this->encodeData($this->getProducerId()),
            "event_admins_id"          => $this->encodeArray($this->getAdminsId(), false)
        ];

        return $array;
	}

	/**
	 * encodeSessions
	 *
	 * @return array
	 */
	private function encodeSessions() {
		$sessions = $this->sessions;
		$encoded_sessions = [];

		foreach($sessions as $session) {
			if (is_array($session)) {
				$partial_session = [];
				foreach($session as $key => $value) {
					$partial_session[$key] = $this->encodeData($value);
				}
				array_push($encoded_sessions, $partial_session);
			}
		}
		return $encoded_sessions;
	}
}

?>