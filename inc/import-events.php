<?php

if( defined( 'WP_CLI' ) && WP_CLI ) {

  class Import_Events {
    
    public function insert_or_update_events() {
      $jsonFile = file_get_contents( __DIR__ . '/events-data/events.json' );

      // If the file does not exist then bail
      if ( !$jsonFile ) {
        return false;
      }

      // decode the json file
      $eventsData = json_decode( $jsonFile );

      // if it breaks then bail
      if( !$eventsData ) {
        return false;
      }

      // if contains data then loop over it
      if( !empty( $eventsData ) ) {
        foreach( $eventsData as $event ) {
          $eventTitle = $event->title;
          $eventID = $event->id;

          $eventContent = array(
            'import_id'    => $eventID,
            'post_title'   => $event->title,
            'post_content' => $event->about,
            'post_type'    => 'events',
            'post_status'  => 'publish'
          );

          $acfContent = array(
            'field_62fa1d18f2097' => $event->about,
            'field_62fa1d24f2098' => $event->organizer,
            'field_62fa1d53f2099' => $event->timestamp,
            'field_62fa1d5ef209a' => $event->email,
            'field_62fa1d6cf209b' => $event->address,
            'field_62fa1d95f209c' => $event->latitude,
            'field_62fa1db9f209d' => $event->longitude,
          );

          // test to see if the post doesn't exist. Insert it if not or update it if so.
          if( 'publish' !== get_post_status( $eventID ) ) {
            $eventPost = wp_insert_post( $eventContent, true );

            // Update the ACF fields
            $this->update_acf_fields( $acfContent, $eventID );

            if( $eventPost ) {
              wp_set_object_terms( $eventPost, $event->tags, 'events_tag' );
            }

            // give output
            WP_CLI::success( 'Importing this event: ' . $eventTitle );

            // send the email notification
            $this->send_success_email('imported');
          } else {
            wp_update_post( $eventContent, true );

            // Update the ACF fields
            $this->update_acf_fields( $acfContent, $eventID );

            // give output
            WP_CLI::success( 'Updating this event: ' . $eventTitle );

            // send the email notification
            $this->send_success_email('updated');
          }
        }
      }
    }

    private function update_acf_fields( $values, $postID ) {
      foreach( $values as $key => $value ) {
        update_field( $key, $value, $postID );
      }
    }

    private function send_success_email( $eventStatus ) {
      // Destination email address.
      $to = 'allanfitzpatrick9@gmail.com';

      // Email subject.
      $subject = ucfirst( $eventStatus ) . ': complete';

      $body = '';

      $args = array(
        'post_type' => 'events',
        'posts_per_page' => -1
      );

      // get the event posts
      $events = get_posts( $args );

      foreach( $events as $event ) {
        // Email body message depending on event status (imported or updated)
        if( $eventStatus === 'imported' ) {
          $body = 'Importing Events: was completed at '. date("d-m-Y H:m:s"). "\r\n" .'Events Imported: '.$event->post_title. "\r\n";
        } else {
          $body = 'Updating Events: was completed at '. date("d-m-Y H:m:s"). "\r\n" .'Events Updated: '.$event->post_title. "\r\n";
        }
      }

      // Send the email as HTML.
      $headers = array( 'Content-Type: text/html; charset=UTF-8' );

      // Send via WordPress email.
      wp_mail( $to, $subject, $body, $headers );
    }
  }

  WP_CLI::add_command( 'import_data', 'Import_Events' );

}