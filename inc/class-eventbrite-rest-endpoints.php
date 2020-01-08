<?php
 
class Eventbrite_Routes extends WP_REST_Controller {
 
    /**
    * Register the routes for the eventbrite plugin.
    */
    public function register_routes() {
        $version = '1';
        $namespace = 'eventbrite/v' . $version;

        register_rest_route( $namespace, '/events/user', array(
            array(
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => array( $this, 'get_user_events' ),
                'permission_callback' => array( $this, 'get_events_permissions_check' ),
                'args'                => array(),
            )
        ));
    }
 
    /**
    * Check if a given request has access to get events
    *
    * @param WP_REST_Request $request Full data about the request.
    * @return WP_Error|bool
    */
    public function get_events_permissions_check( $request ) {
        return true;
    }

    /**
    * Get a collection of events for the currently connected user
    *
    * @param WP_REST_Request $request Full data about the request.
    * @return WP_Error|WP_REST_Response
    */
    public function get_user_events( $request ) {
        $data = eventbrite_get_events( array(), true);
 
        return new WP_REST_Response( $data, 200 );
    }
}