var apiKey = '45995892';
var sessionId = '2_MX40NTk5NTg5Mn5-MTUxMDA2MjgyMDE3MX5QaUJKZWkvU214Uk1WQXNWMWp2Y3Bqak1-fg';
var token = 'T1==cGFydG5lcl9pZD00NTk5NTg5MiZzaWc9N2RmNjNmZjdmZjg4MWM2YWU4ZDgyZTY0ODdhMzc5YWNjMGY4OWI4ZTpzZXNzaW9uX2lkPTJfTVg0ME5UazVOVGc1TW41LU1UVXhNREEyTWpneU1ERTNNWDVRYVVKS1pXa3ZVMjE0VWsxV1FYTldNV3AyWTNCcWFrMS1mZyZjcmVhdGVfdGltZT0xNTEwMTE2NTQyJm5vbmNlPTAuMTE1ODMzNzMzMjQxNDMxNjUmcm9sZT1wdWJsaXNoZXImZXhwaXJlX3RpbWU9MTUxMjcwODU0MyZpbml0aWFsX2xheW91dF9jbGFzc19saXN0PQ==';
var session;
var videoPresId;
function initializeSession(preqid) {
	
  
   session = OT.initSession(apiKey, sessionId);
   videoPresId = preqid;
  // Subscribe to a newly created stream
  session.on('streamCreated', function(event) {
    var subscriberOptions = {
      insertMode: 'append',
      width: '100%',
      height: '100%'
    };
    session.subscribe(event.stream, 'subscriber', subscriberOptions, function(error) {
      if (error) {
        console.log('There was an error publishing: ', error.name, error.message);
      }
    });
  });

  session.on('sessionDisconnected', function(event) {
    console.log('You were disconnected from the session.', event.reason);
  });

  // Connect to the session
  session.connect(token, function(error) {
    // If the connection is successful, initialize a publisher and publish to the session
    if (!error) {
      var publisherOptions = {
        insertMode: 'append',
        width: '100%',
        height: '100%'
      };
      var publisher = OT.initPublisher('publisher', publisherOptions, function(error) {
        if (error) {
          console.log('There was an error initializing the publisher: ', error.name, error.message);
          return;
        }
        session.publish(publisher, function(error) {
          if (error) {
            console.log('There was an error publishing: ', error.name, error.message);
          }
        });
      });
    } else {
      console.log('There was an error connecting to the session: ', error.name, error.message);
    }
  });
}
