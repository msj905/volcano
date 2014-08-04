<?php

/**
 * The seller contacts controller.
 */
class Controller_Settings_Contacts extends Controller
{
	/**
	 * Displays a seller's contacts.
	 *
	 * @return void
	 */
	public function action_index()
	{
		$seller = Seller::active();
		
		$this->view->contacts = $seller->contacts;
		$this->view->primary  = Service_Contact::primary($seller);
	}
	
	/**
	 * GET create action.
	 * 
	 * @return void
	 */
	public function get_create() {}
	
	/**
	 * POST create action.
	 * 
	 * @return void
	 */
	public function post_create()
	{
		$this->get_create();
		
		$contact = new Model_Contact;
		$contact->populate(Input::post());
		
		$validator = Validation_Contact::create('seller');
		if (!$validator->run()) {
			Session::set_alert('error', __('form.error'));
			$this->view->errors = $validator->error();
			return;
		}
		
		$data    = $validator->validated();
		$data['first_name'] = '';
		$data['last_name'] = '';
		
		if (!$new_contact = Service_Contact::create($data)) {
			Session::set_alert('error', 'There was an error creating the contact.');
			return;
		}
		
		Service_Contact::link($new_contact, Seller::active());
		
		Session::set_alert('success', 'The contact has been created.');
		Response::redirect('settings/contacts');
	}
	
	/**
	 * GET Edit action.
	 *
	 * @param int $id Contact ID.
	 *
	 * @return void
	 */
	public function get_edit($id = null)
	{
		$this->view->contact = $this->get_contact($id);
	}
	
	/**
	 * POST Edit action.
	 *
	 * @param int $id Contact ID.
	 *
	 * @return void
	 */
	public function post_edit($id = null)
	{
		$this->get_edit($id);
		
		$validator = Validation_Contact::update();
		if (!$validator->run()) {
			Session::set_alert('error', __('form.error'));
			$this->view->errors = $validator->error();
			return;
		}
		
		$contact = $this->get_contact($id);
		$data    = $validator->validated();
		
		if (!Service_Contact::update($contact, $data)) {
			Session::set_alert('error', 'There was an error updating the contact.');
			return;
		}
		
		Session::set_alert('success', 'The contact has been updated.');
		Response::redirect('settings/contacts');
	}
	
	/**
	 * Attempts to get a contact from a given ID.
	 *
	 * @param int $id Contact ID.
	 *
	 * @return Model_Contact
	 */
	protected function get_contact($id)
	{
		$contact = Service_Contact::find_one($id);
		if (!$contact || !in_array($contact, Seller::active()->contacts)) {
			throw new HttpNotFoundException;
		}
		
		return $contact;
	}
}
