<!DOCTYPE html>
<html>
  <head>
    <title>ReferalCode Test</title>
    <link rel="stylesheet" href="./bootstrap.min.css" />
</head>
  <body>
    <div class="col-sm-6 col-sm-offset-3">
      <h1>Referal Code Test</h1>

      <form action="api/referal" method="POST">
        <div id="name-group" class="form-group">
          <label for="referal">Referal Code</label>
          <input
            type="text"
            class="form-control"
            id="referal"
            name="referal"
            placeholder=""
          />
        </div>

        <button type="submit" class="btn btn-success">
          Submit
        </button>
      </form>
    </div>

    <script src="./jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="./form.js"></script>

  </body>
</html>