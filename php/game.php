<?php require 'header.php'?>
<body>
<div class="container">
    <div class="row vertical-center-row">
        <div class="col-md-12">

            <!-- Disconnected from server -->
            <div id="disconnected">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 text-center">
                        <div class="alert alert-danger">
                            <p>Not connected to server.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Waiting room -->
            <div id="waiting-room" style="display:none;">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 text-center">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Waiting Room</div>
                            <div class="panel-body">
                                <p>You are connected to the server.</p>
                                <p>Waiting for another player...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Game -->
            <div id="game" style="display:none;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Battleship Game #<span id="game-number"></span></div>
                            <div class="panel-body">

                                <!-- Player grids -->
                                <div class="row">
                                    <div class="col-md-6 player-grid text-center">
                                        <h3>You</h3>
                                        <canvas id="canvas-grid1" width="361" height="361">Browser does not support canvas.</canvas>
                                    </div>
                                    <div class="col-md-6 player-grid text-center">
                                        <h3>Opponent</h3>
                                        <canvas id="canvas-grid2" width="361" height="361">Browser does not support canvas.</canvas>
                                    </div>
                                </div>
                                
                                
                            </div>

                            <ul class="list-group">
                                <!-- Status -->
                                <li class="list-group-item text-center" id="turn-status"></li>

                                <!-- Chat messages -->
                                <li class="list-group-item" id="messages-list">
                                    <ul id="messages"></ul>
                                </li>

                                <!-- Send chat message form -->
                                <li class="list-group-item">
                                    <form id="message-form" action="">
                                        <div class="input-group">
                                        <input id="message" class="form-control" autocomplete="off" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Send Message</button>
                                        </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.3.5/socket.io.min.js"></script>
<script type="text/javascript" src="/js/game.js"></script>
<script type="text/javascript" src="/js/client.js"></script>
<?php require 'footer.php'; ?> 