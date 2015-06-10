<?php

namespace ApiPosts\MetaBoxes;

/**
 * Class ExtendPublish.
 */
class ExtendPublish
{
    /**
     * @var \Twig_Environment
     */
    protected $view;

    /**
     * Metabox name.
     *
     * @var string
     */
    protected $name;

    /**
     * Metabox nonce.
     *
     * @var string
     */
    protected $nonce;

    /**
     * Metabox key (name in database).
     *
     * @var string
     */
    protected $metaKey;

    /**
     *  Constructs the metabox.
     */
    public function __construct()
    {
        $this->view = herbert('twig');
        $this->name = 'apiposts_enable_api';
        $this->nonce = 'apiposts_enable_api_nonce';
        $this->metaKey = '_apiposts_enable_api_key';

        add_action('post_submitbox_misc_actions', [$this, 'add']);
        add_action('save_post', [$this, 'save']);
    }

    /**
     * Gets post and fetches template.
     */
    public function add()
    {
        $post = $this->getPost();

        if ($post->post_type !== 'post') {
            return;
        }

        $this->template($post);
    }

    /**
     * Prints out the metabox template.
     *
     * @param $post
     */
    public function template($post)
    {
        $value = get_post_meta($post->ID, $this->metaKey, true);

        wp_nonce_field($this->name, $this->nonce);

        echo $this->view->render('@ApiPosts/metaboxes/extendPublish.twig', [
            'checked' => $value === 'yes',
        ]);
    }

    /**
     * Handles the save of metabox values.
     *
     * @param $postID
     *
     * @return mixed
     */
    public function save($postID)
    {
        $validator = new Validator();
        $http = herbert('http');

        if (!$validator->validateSave($this->nonce, $this->name, $postID)) {
            return $postID;
        }

        update_post_meta($postID, $this->metaKey, $http->get('apiposts_enable_api'));
    }

    /**
     * Returns the current post.
     *
     * @return mixed
     */
    public function getPost()
    {
        global $post;

        return $post;
    }
}
