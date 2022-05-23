<style type="text/css">
            .nl-esi-shadow .sec-title {
                border: 1px solid #ebebeb;
                background: #fff;
                color: #d54e21;
                padding: 2px 4px;
            }
            .nl-esi-shadow{
                border:1px solid #ebebeb; padding:5px 20px; background:#fff; margin-bottom:40px;
                -webkit-box-shadow: 4px 4px 10px 0px rgba(50, 50, 50, 0.1);
                -moz-box-shadow:    4px 4px 10px 0px rgba(50, 50, 50, 0.1);
                box-shadow:         4px 4px 10px 0px rgba(50, 50, 50, 0.1);
            }
</style>
<div class="wrap">
            <h1>CBQ APP MANAGER API Endpoints</h1>
    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Authentication</h4></legend>
        <p>You need to create a bearer token or you can use <a href="https://wordpress.org/plugins/jwt-auth/">jwt-auth</a> </p>
        <p><strong>Endpoint:</strong><code> /wp-json/jwt-auth/v1/token </code><p>
        <p><strong>Method:</strong><code> POST </code><p>
        <p><strong>Param:</strong><code> {"username": "your-username","password":"your-password"} </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
        "token": "******************************************************",
        "user_email": "***@***.com",
        "user_nicename": "****",
        "user_display_name": "****"
}</code></pre>
    </fieldset>

    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Get User Tags & Memberships</h4></legend>
        <p><strong>Endpoint:</strong><code> wp-json/cbq-app-manager/v1/user-tags-memberships/ </code><p>
        <p><strong>Method:</strong><code> GET </code><p>
        <p><strong>Param:</strong><code> None    </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
    "userTags": [
        {
            "id": 140,
            "value": "Purchased Program",
            "userID": 1
        },
        {
            "id": 6053,
            "value": "Customer",
            "userID": 1
        },
        {
            "id": 6313,
            "value": "Purchased Offer 2 Default Backend",
            "userID": 1
        }
    ],
    "userMemberships": [
        {
            "id": 49,
            "title": "The CBQ Program",
            "userID": 1
        },
        {
            "id": 268,
            "title": "Craving Crusher (Lifetime)",
            "userID": 1
        }
    ]
}</code></pre>
    </fieldset>
    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Get Access Rules</h4></legend>
        <p><strong>Endpoint:</strong><code> wp-json/cbq-app-manager/v1/access-rules </code><p>
        <p><strong>Method:</strong><code> GET </code><p>
        <p><strong>Param:</strong><code> None    </code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
  "RuleSet": [
    {
      "title": "ProgressMonitorView",
      "type": "static",
      "rules": [
        {
          "tags": [
            "Membership: Breathe Life Program",
            "Membership: CBQ Program"
          ],
          "memberships": ["Breathe Life Program", "Craving Crusher (Lifetime)"],
          "tagsNOT": ["Tag5", "Tag6"],
          "membershipsNOT": ["MSH5"],
          "quitDateBeforeToday": true,
          "quitDateMore": 2,
          "quitDateLess": 300
        },
        {
          "tags": ["Tag1"],
          "memberships": ["MSH2", "MSH3"],
          "tagsNOT": ["Tag4", "Tag6"],
          "membershipsNOT": ["MSH9"]
        },
        {
          "memberships": ["admin"],
          "tags": [],
          "tagsNOT": [],
          "membershipsNOT": []
        }
      ],
      "errorMessages": [
        {
          "enabled": "yes or no",
          "message": "You do not have access to this tool",
          "buttonURL": "https://gobuynow.com"
        }
      ]
    },
    {
      "title": "CravingCrusherView",
      "type": "static",
      "rules": [
        {
          "tags": ["Membership: CBQ Program"],
          "memberships": ["Craving Crusher (Lifetime)"],
          "tagsNOT": [],
          "membershipsNOT": ["MSH5"],
          "quitDateBeforeToday": true,
          "quitDateMore": 2,
          "quitDateLess": 1000
        },
        {
          "memberships": ["admin"],
          "tags": [],
          "tagsNOT": [],
          "membershipsNOT": []
        }
      ],
      "errorMessages": [
        {
          "enabled": "yes or no",
          "message": "You do not have access to this tool",
          "buttonURL": "https://gobuynow.com"
        }
      ]
    },
    {
      "title": "NotebookLoggerView",
      "type": "static",
      "rules": [
        {
          "tags": ["Membership: Breathe Life Program"],
          "memberships": ["Breathe Life Program"],
          "tagsNOT": ["Test Not Logged In5", "Test Not Logged In6"],
          "membershipsNOT": ["MSH5"]
        },
        {
          "memberships": ["admin"],
          "tags": [],
          "tagsNOT": [],
          "membershipsNOT": []
        }
      ],
      "errorMessages": [
        {
          "enabled": "yes or no",
          "message": "You do not have access to this tool",
          "buttonURL": "https://gobuynow.com"
        }
      ]
    },
    {
      "title": "TipsView",
      "type": "static",
      "rules": [
        {
          "tags": ["Consumption: Logged In to Membership site"],
          "memberships": ["Breathe Life Program"],
          "tagsNOT": ["Test Not Logged In4"],
          "membershipsNOT": ["MSH5"]
        },
        {
          "memberships": ["admin"],
          "tags": [],
          "tagsNOT": [],
          "membershipsNOT": []
        }
      ],
      "errorMessages": [
        {
          "enabled": "yes or no",
          "message": "You do not have access to this tool",
          "buttonURL": "https://gobuynow.com"
        }
      ]
    },
    {
      "title": "Dynamic Component 1",
      "type": "dynamic",
      "rules": [],
      "errorMessages": [],
      "details": {
        "title": "Component 1",
        "description": "This is a Description",
        "close": true,
        "buttons": [
          {
            "type": "ok",
            "text": "More",
            "action": {
              "type": "url, close, sheet",
              "url": "",
              "text": "Sheet Text"
            }
          },
          {
            "type": "alternative",
            "text": "Cancel",
            "action": {
              "type": "close"
            }
          }
        ]
      }
    }
  ]
}</code></pre>
    </fieldset>
    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Add User Tags</h4></legend>
        <p><strong>Endpoint:</strong><code> wp-json/cbq-app-manager/v1/add-user-tags</code><p>
        <p><strong>Method:</strong><code> POST </code><p>
        <p><strong>Body Param:</strong><code>{
"tags": [5741,5743]
}</code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
    "status": "success"
}</code></pre>
    </fieldset>
    <fieldset class="nl-esi-shadow">
        <legend><h4 class="sec-title">Remove User Tags</h4></legend>
        <p><strong>Endpoint:</strong><code> wp-json/cbq-app-manager/v1/remove-user-tags</code><p>
        <p><strong>Method:</strong><code> POST </code><p>
        <p><strong>Body Param:</strong><code>{
"tags": [5741,5743]
}</code><p>
        <p><strong>Response:</strong></p>
        <pre><code>{
    "status": "success"
}</code></pre>
    </fieldset>
</div>