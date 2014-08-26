alert("sf");

var Droplr = {};

Droplr.common = {
    api_key: 'test',
    base_uri: "http://droplr.app:8000/api/v1",
    timeout: 5000,
    generateQuery: function (options) {
        'use strict';
        var myOptions, query, option;

        myOptions = options || {};
        query = "?api_key=" + Droplr.common.api_key;

        if (Object.keys(myOptions).length > 0) {
            for (option in myOptions) {
                if (myOptions.hasOwnProperty(option) && option !== "id" && option !== "body") {
                    query = query + "&" + option + "=" + myOptions[option];
                }
            }
        }
        return query;
    },
    validateCallbacks: function (callbacks) {
        'use strict';
        if (typeof callbacks[0] !== "function" || typeof callbacks[1] !== "function") {
            throw "Success and error parameters must be functions!";
        }
    },
    client: function (options, success, error) {
        'use strict';
        var method, status, xhr;

        method = options.method || "GET";
        status = options.status || 200;
        xhr = new XMLHttpRequest();

        xhr.ontimeout = function () {
            error('{"status_code":408,"status_message":"Request timed out"}');
        };

        xhr.open(method, Droplr.common.base_uri + options.url, true);

        if(options.method === "POST") {
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Accept", "application/json");
        }

        xhr.timeout = Droplr.common.timeout;

        xhr.onload = function (e) {
            if (xhr.readyState === 4) {
                if (xhr.status === status) {
                    success(xhr.responseText);
                } else {
                    error(xhr.responseText);
                }
            } else {
                error(xhr.responseText);
            }
        };

        xhr.onerror = function (e) {
            error(xhr.responseText);
        };
        if (options.method === "POST") {
            xhr.send(JSON.stringify(options.body));
        } else {
            xhr.send(null);
        }
    }
};

Droplr.drops = {
    getAll: function (success, error) {
        'use strict';

        Droplr.common.validateCallbacks([success, error]);

        Droplr.common.client(
            {
                url: "/drop" + Droplr.common.generateQuery()
            },
            success,
            error
        );
    },
    getById: function (options, success, error) {
        'use strict';

        Droplr.common.validateCallbacks([success, error]);

        Droplr.common.client(
            {
                url: "/drop/" + options.id + Droplr.common.generateQuery(options)
            },
            success,
            error
        );
    }
}