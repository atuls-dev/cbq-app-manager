<?php
class CBQ_App_Api_Controller extends WP_REST_Controller
{
    public function register_routes()
    {
        $version = "1";
        $namespace = "v" . $version;
        $base = "/cbq-app-manager";
        register_rest_route(
          $base . "/" . $namespace,
          "/" . "user-tags-memberships",
          [
            [
              "methods" => WP_REST_Server::READABLE,
              "callback" => [$this, "get_user_tags_memberships"],
              "permission_callback" => [$this, "get_user_permissions_check"],
            ],
          ]
        );

        register_rest_route($base . "/" . $namespace, "/" . "access-rules", [
          [
            "methods" => WP_REST_Server::READABLE,
            "callback" => [$this, "get_access_rules"],
            "permission_callback" => [$this, "get_user_permissions_check"],
          ],
        ]);

        register_rest_route($base . "/" . $namespace, '/' . "add-user-tags/", [
        //register_rest_route($base . "/" . $namespace, '/' . "add-user-tags/". "(?P<tags>[,0-9]+)", [
          [
            "methods" => WP_REST_Server::CREATABLE,
            "callback" => [$this, "set_user_tags"],
            "permission_callback" => [$this, "get_user_permissions_check"],
          ],
        ]);

        register_rest_route($base . "/" . $namespace, '/' . "remove-user-tags/", [
        //register_rest_route($base . "/" . $namespace, '/' . "remove-user-tags/". "(?P<tags>[,0-9]+)", [
          [
            "methods" => WP_REST_Server::CREATABLE,
            "callback" => [$this, "remove_user_tags"],
            "permission_callback" => [$this, "get_user_permissions_check"],
          ],
        ]);
    }

    public function get_user_permissions_check($request)
    {
        return is_user_logged_in();
    }

    public function get_access_rules($request)
    {
        //$post = $request->get_params();
        $file_path = CAM_ASSETS_PATH . "json/rules.json";

        $json = file_get_contents($file_path);

        // Decode the JSON file
        $jsonData = json_decode($json, true);

        $response = new WP_REST_Response($jsonData);
        $response->set_status(200);
        return $response;
    }

    public function get_user_tags_memberships($request)
    {
        //$post = $request->get_params();
        $userId = get_current_user_id();
        $userData = [];

        // $user_data = get_userdata($userId);
        // $user_email = $user_data->data->user_email;
        // $contact_id = wp_fusion()->crm->get_contact_id( $user_email );
        // $tags = wp_fusion()->crm->get_tags( $contact_id );

        $userTags = [];
        $tags = wp_fusion()->user->get_tags($userId);
        if (!empty($tags)) {
          foreach ($tags as $tagID) {
            $userTags[] = [
              "id" => (int) $tagID,
              "value" => wp_fusion()->user->get_tag_label($tagID),
              "userID" => (int) $userId,
            ];
          }
        }
        $userData["userTags"] = $userTags;
        $membershipData = [];
        if (class_exists("MeprUser")) {
          $member = new MeprUser(); // initiate the class
          $member->ID = $userId; // if using this in admin area, you'll need this to make user id the member id
          $memberships = $member->active_product_subscriptions(); //MeprUser function that gets subscription title
          if (!empty($memberships)) {
            foreach ($memberships as $msId) {
              $membershipData[] = [
                "id" => (int) $msId,
                "title" => get_the_title($msId),
                "userID" => (int) $userId,
              ];
            }
          }
        }

        $userData["userMemberships"] = $membershipData;
        $response = new WP_REST_Response($userData);
        $response->set_status(200);
        return $response;
    }

    public function set_user_tags($request)
    {

        $item = $request->get_params();
    
        $tags = $item['tags'];

        $userId = get_current_user_id();

        $return = wp_fusion()->user->apply_tags( $tags, $userId );
        if ( $return ) {
            $return = array( 'status' => 'success' );
            $response = new WP_REST_Response($return);
            $response->set_status(200);
        }
        return $response;
    }

    public function remove_user_tags($request)
    { 
         $item = $request->get_params();
       
        $tags = $item['tags'];
        
        $userId = get_current_user_id();

        $return = wp_fusion()->user->remove_tags( $tags, $userId );
        if ( $return ) {
            $return = array( 'status' => 'success' );
            $response = new WP_REST_Response($return);
            $response->set_status(200);
        }
        return $response;
    }
    

}
add_action("rest_api_init", function () {
    $CBQ_API_Obj = new CBQ_App_Api_Controller();
    $CBQ_API_Obj->register_routes();
});
